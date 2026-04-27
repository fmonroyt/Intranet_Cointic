<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\AreaModel;
use App\Models\EmployeeModel;

class Admin extends BaseController
{
    public function employees()
    {
        $this->requireAdmin();

        $areaModel = new AreaModel();
        $employeeModel = new EmployeeModel();

        return view('admin/employees', [
            'title' => 'Catálogo de empleados',
            'areas' => $areaModel->orderBy('name', 'asc')->findAll(),
            'employees' => $employeeModel->orderBy('first_name', 'asc')->findAll(),
        ]);
    }

    public function createEmployee()
    {
        $this->requireAdmin();

        $employeeModel = new EmployeeModel();
        $areaModel = new AreaModel();

        $data = [
            'first_name' => trim((string) $this->request->getPost('first_name')),
            'last_name_paternal' => trim((string) $this->request->getPost('last_name_paternal')),
            'last_name_maternal' => trim((string) $this->request->getPost('last_name_maternal')),
            'position' => trim((string) $this->request->getPost('position')),
            'area_id' => (int) $this->request->getPost('area_id'),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')),
            'address' => trim((string) $this->request->getPost('address')),
            'role' => 'employee',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if (! $areaModel->find($data['area_id'])) {
            return redirect()->back()->with('error', 'Área inválida.');
        }

        $plainPassword = bin2hex(random_bytes(4));
        $data['password_hash'] = password_hash($plainPassword, PASSWORD_DEFAULT);

        $employeeModel->insert($data);

        $emailService = service('email');
        $emailService->setTo($data['email']);
        $emailService->setSubject('Acceso a la intranet de viáticos');
        $emailService->setMessage(view('emails/new_employee', [
            'employee' => $data,
            'password' => $plainPassword,
        ]));
        $emailService->send();

        return redirect()->back()->with('success', 'Empleado registrado y contraseña enviada.');
    }
}
