<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'user_id',
        'makanan_id',
        'penjual_id',
        'jumlah',
        'total_harga',
        'catatan',
        'status',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'makanan_id' => 'required|numeric',
        'jumlah'     => 'required|numeric|greater_than[0]',
    ];

    /**
     * Riwayat pesanan milik seorang pembeli, lengkap dengan nama makanan.
     */
    public function riwayatPembeli(int $userId)
    {
        return $this->select('pesanan.*, makanan.nama_makanan, makanan.gambar')
            ->join('makanan', 'makanan.id = pesanan.makanan_id', 'left')
            ->where('pesanan.user_id', $userId)
            ->orderBy('pesanan.id', 'DESC')
            ->findAll();
    }

    /**
     * Pesanan masuk untuk seorang penjual (produk miliknya yang dipesan).
     */
    public function pesananMasukUntukPenjual(int $penjualId)
    {
        return $this->select('pesanan.*, makanan.nama_makanan, users.nama as nama_pembeli')
            ->join('makanan', 'makanan.id = pesanan.makanan_id', 'left')
            ->join('users', 'users.id = pesanan.user_id', 'left')
            ->where('pesanan.penjual_id', $penjualId)
            ->orderBy('pesanan.id', 'DESC')
            ->findAll();
    }

    /**
     * Semua pesanan (untuk admin).
     */
    public function semuaPesanan()
    {
        return $this->select('pesanan.*, makanan.nama_makanan, users.nama as nama_pembeli')
            ->join('makanan', 'makanan.id = pesanan.makanan_id', 'left')
            ->join('users', 'users.id = pesanan.user_id', 'left')
            ->orderBy('pesanan.id', 'DESC')
            ->findAll();
    }
}
