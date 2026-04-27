<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\EmployeeModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login', [
            'title' => 'Acceso a la intranet',
        ]);
    }

    public function attempt()
    {
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->where('email', $email)->first();

        if (! $employee || ! password_verify($password, $employee['password_hash'])) {
            return redirect()->back()->with('error', 'Credenciales inválidas.');
        }

        $this->session->set([
            'employee_id' => $employee['id'],
            'employee_name' => $employee['first_name'] . ' ' . $employee['last_name_paternal'],
            'role' => $employee['role'],
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
