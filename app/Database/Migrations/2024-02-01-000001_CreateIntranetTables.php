<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIntranetTables extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 120],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('areas', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 120],
            'requires_project' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('expense_types', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 120],
            'last_name_paternal' => ['type' => 'VARCHAR', 'constraint' => 120],
            'last_name_maternal' => ['type' => 'VARCHAR', 'constraint' => 120],
            'position' => ['type' => 'VARCHAR', 'constraint' => 120],
            'area_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 160],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 40],
            'address' => ['type' => 'VARCHAR', 'constraint' => 220],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => 'employee'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->addForeignKey('area_id', 'areas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('employees', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'employee_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'area_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'expense_type_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'excel_id' => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
            'request_date' => ['type' => 'DATE'],
            'visit_place' => ['type' => 'VARCHAR', 'constraint' => 180],
            'start_date' => ['type' => 'DATE'],
            'end_date' => ['type' => 'DATE'],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'summary' => ['type' => 'TEXT'],
            'project' => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'approved_manager' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'approved_accounting' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('area_id', 'areas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('expense_type_id', 'expense_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('travel_requests', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('travel_requests', true);
        $this->forge->dropTable('employees', true);
        $this->forge->dropTable('expense_types', true);
        $this->forge->dropTable('areas', true);
    }
}
