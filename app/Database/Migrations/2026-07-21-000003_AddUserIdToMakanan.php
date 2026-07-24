<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToMakanan extends Migration
{
    public function up()
    {
        // Kolom pemilik (penjual) untuk setiap data makanan.
        // Nullable supaya data lama / data yang dibuat admin tetap kompatibel.
        $this->forge->addColumn('makanan', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('makanan', 'user_id');
    }
}
