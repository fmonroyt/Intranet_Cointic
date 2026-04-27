<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ExpenseTypeModel extends Model
{
    protected $table = 'expense_types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'requires_project'];
    protected $useTimestamps = false;
}
