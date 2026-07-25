<?php

namespace App\Controllers;

use App\Models\MakananModel;
use App\Models\PesananModel;

class PesananController extends BaseController
{
    protected PesananModel $pesananModel;
    protected MakananModel $makananModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->makananModel = new MakananModel();
    }

    /**
     * Pembeli membuat pesanan baru untuk sebuah makanan
     */
    public function pesan($makananId)
    {
        $makanan = $this->makananModel->find($makananId);

        if (!$makanan) {
            return redirect()->to('/')->with('gagal', 'Makanan tidak ditemukan.');
        }

        $rules = [
            'jumlah' => 'required|numeric|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/')->with('gagal', 'Jumlah pesanan tidak valid.');
        }

        $jumlah = (int) $this->request->getPost('jumlah');

        $this->pesananModel->insert([
            'user_id'     => session()->get('user_id'),
            'makanan_id'  => $makanan['id'],
            'penjual_id'  => $makanan['user_id'] ?? null,
            'jumlah'      => $jumlah,
            'total_harga' => $jumlah * (int) $makanan['harga'],
            'catatan'     => $this->request->getPost('catatan'),
            'status'      => 'Menunggu',
        ]);

        return redirect()->to('/pesanan-saya')->with('sukses', 'Pesanan "' . $makanan['nama_makanan'] . '" berhasil dibuat.');
    }

    /**
     * Riwayat pesanan milik pembeli yang sedang login
     */
    public function saya()
    {
        $data = [
            'title'   => 'Pesanan Saya',
            'pesanan' => $this->pesananModel->riwayatPembeli(session()->get('user_id')),
        ];

        return view('pesanan/saya', $data);
    }

    /**
     * Pesanan masuk untuk penjual, atau semua pesanan untuk admin
     */
    public function masuk()
    {
        $role = session()->get('role');

        $data = [
            'title'   => 'Pesanan Masuk',
            'pesanan' => $role === 'admin'
                ? $this->pesananModel->semuaPesanan()
                : $this->pesananModel->pesananMasukUntukPenjual(session()->get('user_id')),
        ];

        return view('pesanan/masuk', $data);
    }

    /**
     * Ubah status pesanan (penjual pemilik produk atau admin)
     */
    public function updateStatus($id)
    {
        $pesanan = $this->pesananModel->find($id);

        if (!$pesanan) {
            return redirect()->back()->with('gagal', 'Pesanan tidak ditemukan.');
        }

        $role = session()->get('role');

        if ($role !== 'admin' && (int) $pesanan['penjual_id'] !== (int) session()->get('user_id')) {
            return redirect()->back()->with('gagal', 'Anda tidak berhak mengubah pesanan ini.');
        }

        $status = $this->request->getPost('status');

        if (!in_array($status, ['Menunggu', 'Diproses', 'Selesai', 'Dibatalkan'], true)) {
            return redirect()->back()->with('gagal', 'Status tidak valid.');
        }

        $this->pesananModel->update($id, ['status' => $status]);

        return redirect()->back()->with('sukses', 'Status pesanan berhasil diperbarui.');
    }
}
