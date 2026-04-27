<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run(): void
    {
        $this->db->table('areas')->insertBatch([
            ['name' => 'Marketing'],
            ['name' => 'Ingeniería'],
            ['name' => 'Contabilidad'],
        ]);

        $this->db->table('expense_types')->insertBatch([
            ['name' => 'Soporte', 'requires_project' => 1],
            ['name' => 'Ventas', 'requires_project' => 0],
            ['name' => 'Prospección', 'requires_project' => 1],
            ['name' => 'Capacitaciones', 'requires_project' => 0],
        ]);

        $this->db->table('employees')->insert([
            'first_name' => 'Admin',
            'last_name_paternal' => 'Intranet',
            'last_name_maternal' => 'Cointic',
            'position' => 'Administrador',
            'area_id' => 1,
            'email' => 'admin@cointic.local',
            'phone' => '0000000000',
            'address' => 'N/A',
            'password_hash' => password_hash('Admin1234', PASSWORD_DEFAULT),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
