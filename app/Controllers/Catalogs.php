<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\AreaModel;
use App\Models\ExpenseTypeModel;

class Catalogs extends BaseController
{
    public function areas()
    {
        $this->requireAdmin();

        $areaModel = new AreaModel();

        return view('catalogs/areas', [
            'title' => 'Catálogo de áreas',
            'areas' => $areaModel->orderBy('name', 'asc')->findAll(),
        ]);
    }

    public function createArea()
    {
        $this->requireAdmin();

        $areaModel = new AreaModel();
        $areaModel->insert([
            'name' => trim((string) $this->request->getPost('name')),
        ]);

        return redirect()->back()->with('success', 'Área agregada al catálogo.');
    }

    public function expenseTypes()
    {
        $this->requireAdmin();

        $expenseTypeModel = new ExpenseTypeModel();

        return view('catalogs/expense_types', [
            'title' => 'Catálogo de tipos de gasto',
            'expenseTypes' => $expenseTypeModel->orderBy('name', 'asc')->findAll(),
        ]);
    }

    public function createExpenseType()
    {
        $this->requireAdmin();

        $expenseTypeModel = new ExpenseTypeModel();
        $expenseTypeModel->insert([
            'name' => trim((string) $this->request->getPost('name')),
            'requires_project' => $this->request->getPost('requires_project') ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Tipo de gasto agregado al catálogo.');
    }
}
