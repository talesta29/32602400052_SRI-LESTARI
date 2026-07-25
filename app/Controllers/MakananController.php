<?php

namespace App\Controllers;

use App\Models\MakananModel;

class MakananController extends BaseController
{
    protected MakananModel $makananModel;

    public function __construct()
    {
        $this->makananModel = new MakananModel();
    }

    /**
     * READ - Tampilkan semua data makanan (dashboard admin)
     */
    public function index()
    {
        $keyword   = $this->request->getGet('q');
        $role      = session()->get('role');
        $userId    = session()->get('user_id');
        // Admin melihat semua produk, penjual hanya melihat produk miliknya sendiri.
        $ownerOnly = $role === 'penjual' ? $userId : null;

        if (!empty($keyword)) {
            $makanan = $this->makananModel->cari($keyword, $ownerOnly);
        } else {
            $builder = $this->makananModel->orderBy('id', 'DESC');
            if ($ownerOnly !== null) {
                $builder = $builder->where('user_id', $ownerOnly);
            }
            $makanan = $builder->findAll();
        }

        $data = [
            'title'   => 'Kelola Data Makanan',
            'makanan' => $makanan,
            'keyword' => $keyword,
        ];

        return view('makanan/index', $data);
    }

    /**
     * CREATE - Tampilkan form tambah data
     */
    public function create()
    {
        $data = [
            'title'    => 'Tambah Makanan',
            'validasi' => \Config\Services::validation(),
        ];

        return view('makanan/create', $data);
    }

    /**
     * CREATE - Simpan data baru ke database
     */
    public function store()
    {
        $rules = [
            'nama_makanan' => 'required|min_length[3]|max_length[100]',
            'kategori'     => 'required|max_length[50]',
            'harga'        => 'required|numeric',
            'stok'         => 'permit_empty|numeric',
            'gambar'       => 'permit_empty|max_size[gambar,2048]|is_image[gambar]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = null;

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move(FCPATH . 'uploads/makanan', $namaGambar);
        }

        $this->makananModel->save([
            'user_id'      => session()->get('user_id'),
            'nama_makanan' => $this->request->getPost('nama_makanan'),
            'kategori'     => $this->request->getPost('kategori'),
            'harga'        => $this->request->getPost('harga'),
            'stok'         => $this->request->getPost('stok') ?: 0,
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'gambar'       => $namaGambar,
            'status'       => $this->request->getPost('status') ?: 'Tersedia',
        ]);

        return redirect()->to('/makanan')->with('sukses', 'Data makanan berhasil ditambahkan.');
    }

    /**
     * Pastikan penjual hanya bisa mengakses produk miliknya sendiri.
     * Admin selalu diizinkan.
     */
    private function tolakJikaBukanPemilik(array $makanan): bool
    {
        $role = session()->get('role');

        if ($role === 'admin') {
            return false;
        }

        return (int) ($makanan['user_id'] ?? 0) !== (int) session()->get('user_id');
    }

    /**
     * UPDATE - Tampilkan form edit data
     */
    public function edit($id)
    {
        $makanan = $this->makananModel->find($id);

        if (!$makanan) {
            return redirect()->to('/makanan')->with('gagal', 'Data makanan tidak ditemukan.');
        }

        if ($this->tolakJikaBukanPemilik($makanan)) {
            return redirect()->to('/makanan')->with('gagal', 'Anda tidak berhak mengubah produk milik penjual lain.');
        }

        $data = [
            'title'   => 'Edit Makanan',
            'makanan' => $makanan,
        ];

        return view('makanan/edit', $data);
    }

    /**
     * UPDATE - Simpan perubahan data ke database
     */
    public function update($id)
    {
        $makanan = $this->makananModel->find($id);

        if (!$makanan) {
            return redirect()->to('/makanan')->with('gagal', 'Data makanan tidak ditemukan.');
        }

        if ($this->tolakJikaBukanPemilik($makanan)) {
            return redirect()->to('/makanan')->with('gagal', 'Anda tidak berhak mengubah produk milik penjual lain.');
        }

        $rules = [
            'nama_makanan' => 'required|min_length[3]|max_length[100]',
            'kategori'     => 'required|max_length[50]',
            'harga'        => 'required|numeric',
            'stok'         => 'permit_empty|numeric',
            'gambar'       => 'permit_empty|max_size[gambar,2048]|is_image[gambar]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $makanan['gambar'];

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // hapus gambar lama jika ada
            if ($namaGambar && file_exists(FCPATH . 'uploads/makanan/' . $namaGambar)) {
                unlink(FCPATH . 'uploads/makanan/' . $namaGambar);
            }
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move(FCPATH . 'uploads/makanan', $namaGambar);
        }

        $this->makananModel->update($id, [
            'nama_makanan' => $this->request->getPost('nama_makanan'),
            'kategori'     => $this->request->getPost('kategori'),
            'harga'        => $this->request->getPost('harga'),
            'stok'         => $this->request->getPost('stok') ?: 0,
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'gambar'       => $namaGambar,
            'status'       => $this->request->getPost('status') ?: 'Tersedia',
        ]);

        return redirect()->to('/makanan')->with('sukses', 'Data makanan berhasil diperbarui.');
    }

    /**
     * DELETE - Hapus data makanan
     */
    public function delete($id)
    {
        $makanan = $this->makananModel->find($id);

        if (!$makanan) {
            return redirect()->to('/makanan')->with('gagal', 'Data makanan tidak ditemukan.');
        }

        if ($this->tolakJikaBukanPemilik($makanan)) {
            return redirect()->to('/makanan')->with('gagal', 'Anda tidak berhak menghapus produk milik penjual lain.');
        }

        if (!empty($makanan['gambar']) && file_exists(FCPATH . 'uploads/makanan/' . $makanan['gambar'])) {
            unlink(FCPATH . 'uploads/makanan/' . $makanan['gambar']);
        }

        $this->makananModel->delete($id);

        return redirect()->to('/makanan')->with('sukses', 'Data makanan berhasil dihapus.');
    }
}
