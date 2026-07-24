<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MakananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_makanan' => 'Mie Ayam',
                'kategori'     => 'Makanan Berat',
                'harga'        => 15000,
                'stok'         => 25,
                'deskripsi'    => 'Mie ayam dengan topping ayam suwir, pangsit, dan sayuran segar.',
                'gambar'       => null,
                'status'       => 'Tersedia',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_makanan' => 'Bakso',
                'kategori'     => 'Makanan Berat',
                'harga'        => 17000,
                'stok'         => 20,
                'deskripsi'    => 'Bakso urat dan bakso halus disajikan dengan kuah kaldu sapi hangat.',
                'gambar'       => null,
                'status'       => 'Tersedia',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_makanan' => 'Soto Ayam',
                'kategori'     => 'Makanan Berat',
                'harga'        => 16000,
                'stok'         => 18,
                'deskripsi'    => 'Soto ayam kuah bening dengan suwiran ayam, telur, dan taburan bawang goreng.',
                'gambar'       => null,
                'status'       => 'Tersedia',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_makanan' => 'Sate Ayam',
                'kategori'     => 'Makanan Berat',
                'harga'        => 20000,
                'stok'         => 15,
                'deskripsi'    => 'Sate ayam bakar dengan bumbu kacang khas, disajikan dengan lontong.',
                'gambar'       => null,
                'status'       => 'Tersedia',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_makanan' => 'Nasi Goreng',
                'kategori'     => 'Makanan Berat',
                'harga'        => 15000,
                'stok'         => 22,
                'deskripsi'    => 'Nasi goreng spesial dengan telur, ayam suwir, dan acar segar.',
                'gambar'       => null,
                'status'       => 'Tersedia',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'nama_makanan' => 'Es Teh Manis',
                'kategori'     => 'Minuman',
                'harga'        => 5000,
                'stok'         => 40,
                'deskripsi'    => 'Es teh manis segar cocok menemani makan siang.',
                'gambar'       => null,
                'status'       => 'Tersedia',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('makanan')->insertBatch($data);
    }
}
