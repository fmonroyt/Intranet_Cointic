<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\AreaModel;
use App\Models\EmployeeModel;
use App\Models\ExpenseTypeModel;
use App\Models\TravelRequestModel;
use DateInterval;
use DateTimeImmutable;

class Requests extends BaseController
{
    public function index()
    {
        $this->requireLogin();

        $builder = db_connect()->table('travel_requests');
        $builder->select('travel_requests.*, expense_types.name as expense_name, areas.name as area_name, employees.first_name, employees.last_name_paternal');
        $builder->join('expense_types', 'expense_types.id = travel_requests.expense_type_id');
        $builder->join('areas', 'areas.id = travel_requests.area_id');
        $builder->join('employees', 'employees.id = travel_requests.employee_id');
        $builder->orderBy('travel_requests.created_at', 'DESC');

        if ($this->session->get('role') !== 'admin') {
            $builder->where('travel_requests.employee_id', $this->session->get('employee_id'));
        }

        return view('requests/index', [
            'title' => 'Solicitudes registradas',
            'requests' => $builder->get()->getResultArray(),
            'isAdmin' => $this->session->get('role') === 'admin',
        ]);
    }

    public function new()
    {
        $this->requireLogin();

        $employeeModel = new EmployeeModel();
        $areaModel = new AreaModel();
        $expenseTypeModel = new ExpenseTypeModel();

        $employee = $employeeModel->find($this->session->get('employee_id'));
        $area = $employee ? $areaModel->find($employee['area_id']) : null;

        return view('requests/new', [
            'title' => 'Nueva solicitud',
            'employee' => $employee,
            'area' => $area,
            'expenseTypes' => $expenseTypeModel->orderBy('name', 'asc')->findAll(),
        ]);
    }

    public function create()
    {
        $this->requireLogin();

        $employeeModel = new EmployeeModel();
        $expenseTypeModel = new ExpenseTypeModel();
        $travelRequestModel = new TravelRequestModel();

        $employee = $employeeModel->find($this->session->get('employee_id'));
        $expenseType = $expenseTypeModel->find((int) $this->request->getPost('expense_type_id'));

        if (! $employee || ! $expenseType) {
            return redirect()->back()->with('error', 'Datos inválidos.');
        }

        $requestDate = new DateTimeImmutable((string) $this->request->getPost('request_date'));
        $minDate = (new DateTimeImmutable('today'))->add(new DateInterval('P2D'));

        if ($requestDate < $minDate) {
            return redirect()->back()->with('error', 'La solicitud debe registrarse con 48 horas de antelación.');
        }

        $project = trim((string) $this->request->getPost('project'));
        if ($expenseType['requires_project'] && $project === '') {
            return redirect()->back()->with('error', 'El proyecto es obligatorio para este tipo de gasto.');
        }

        $data = [
            'employee_id' => $employee['id'],
            'area_id' => $employee['area_id'],
            'expense_type_id' => $expenseType['id'],
            'excel_id' => trim((string) $this->request->getPost('excel_id')),
            'request_date' => $requestDate->format('Y-m-d'),
            'visit_place' => trim((string) $this->request->getPost('visit_place')),
            'start_date' => (string) $this->request->getPost('start_date'),
            'end_date' => (string) $this->request->getPost('end_date'),
            'amount' => (float) $this->request->getPost('amount'),
            'summary' => trim((string) $this->request->getPost('summary')),
            'project' => $project !== '' ? $project : null,
            'approved_manager' => 0,
            'approved_accounting' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $travelRequestModel->insert($data);

        return redirect()->to('/requests')->with('success', 'Solicitud registrada correctamente.');
    }

    public function approve(int $requestId)
    {
        $this->requireAdmin();

        $type = (string) $this->request->getPost('approval_type');
        $travelRequestModel = new TravelRequestModel();
        $request = $travelRequestModel->find($requestId);

        if (! $request) {
            return redirect()->back()->with('error', 'Solicitud no encontrada.');
        }

        if ($type === 'manager') {
            $travelRequestModel->update($requestId, ['approved_manager' => 1]);
        }

        if ($type === 'accounting') {
            $travelRequestModel->update($requestId, ['approved_accounting' => 1]);
        }

        return redirect()->back()->with('success', 'Autorización actualizada.');
    }
}
