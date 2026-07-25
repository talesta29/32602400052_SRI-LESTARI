<?php

namespace App\Models;

use CodeIgniter\Model;

class MakananModel extends Model
{
    protected $table            = 'makanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'user_id',
        'nama_makanan',
        'kategori',
        'harga',
        'stok',
        'deskripsi',
        'gambar',
        'status',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_makanan' => 'required|min_length[3]|max_length[100]',
        'kategori'     => 'required|max_length[50]',
        'harga'        => 'required|numeric',
        'stok'         => 'permit_empty|numeric',
    ];

    protected $validationMessages = [
        'nama_makanan' => [
            'required'   => 'Nama makanan wajib diisi.',
            'min_length' => 'Nama makanan minimal 3 karakter.',
        ],
        'harga' => [
            'required' => 'Harga wajib diisi.',
            'numeric'  => 'Harga harus berupa angka.',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Cari makanan berdasarkan kata kunci nama atau kategori.
     * Jika $userId diisi, pencarian dibatasi hanya pada produk milik penjual tersebut.
     */
    public function cari(string $keyword, ?int $userId = null)
    {
        $builder = $this->groupStart()
            ->like('nama_makanan', $keyword)
            ->orLike('kategori', $keyword)
            ->groupEnd();

        if ($userId !== null) {
            $builder = $builder->where('user_id', $userId);
        }

        return $builder->orderBy('id', 'DESC')->findAll();
    }

    /**
     * Ambil semua kategori unik
     */
    public function getKategoriList()
    {
        return $this->distinct()->select('kategori')->orderBy('kategori', 'ASC')->findAll();
    }
}
