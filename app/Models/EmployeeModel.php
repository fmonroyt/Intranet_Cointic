<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'first_name',
        'last_name_paternal',
        'last_name_maternal',
        'position',
        'area_id',
        'email',
        'phone',
        'address',
        'password_hash',
        'role',
        'created_at',
    ];
    protected $useTimestamps = false;
}
