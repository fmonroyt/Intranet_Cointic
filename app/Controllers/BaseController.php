<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;

class BaseController extends Controller
{
    protected $session;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->session = service('session');
    }

    protected function requireLogin(): void
    {
        if (! $this->session->get('employee_id')) {
            redirect()->to('/login')->send();
            exit;
        }
    }

    protected function requireAdmin(): void
    {
        $this->requireLogin();
        if ($this->session->get('role') !== 'admin') {
            redirect()->to('/')->send();
            exit;
        }
    }
}
