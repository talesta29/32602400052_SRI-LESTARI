<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'nama'       => 'Admin Warung',
                'username'   => 'admin',
                'email'      => 'admin@warungnusantara.test',
                'password'   => password_hash('12345', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'no_hp'      => null,
                'alamat'     => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Budi Penjual',
                'username'   => 'penjual1',
                'email'      => 'penjual1@warungnusantara.test',
                'password'   => password_hash('penjual123', PASSWORD_DEFAULT),
                'role'       => 'penjual',
                'no_hp'      => null,
                'alamat'     => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Sari Pembeli',
                'username'   => 'pembeli1',
                'email'      => 'pembeli1@warungnusantara.test',
                'password'   => password_hash('pembeli123', PASSWORD_DEFAULT),
                'role'       => 'pembeli',
                'no_hp'      => null,
                'alamat'     => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($users as $user) {
            // Hindari duplikasi jika seeder dijalankan berkali-kali
            $existing = $this->db->table('users')->where('username', $user['username'])->get()->getRow();
            if (!$existing) {
                $this->db->table('users')->insert($user);
            }
        }
    }
}
