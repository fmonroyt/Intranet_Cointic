<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class TravelRequestModel extends Model
{
    protected $table = 'travel_requests';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'employee_id',
        'area_id',
        'expense_type_id',
        'excel_id',
        'request_date',
        'visit_place',
        'start_date',
        'end_date',
        'amount',
        'summary',
        'project',
        'approved_manager',
        'approved_accounting',
        'created_at',
    ];
    protected $useTimestamps = false;
}
