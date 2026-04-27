<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table = 'areas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
    protected $useTimestamps = false;
}
