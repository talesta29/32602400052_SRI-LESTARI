<?php

namespace App\Controllers;

use App\Models\MakananModel;

class Home extends BaseController
{
    protected MakananModel $makananModel;

    public function __construct()
    {
        $this->makananModel = new MakananModel();
    }

    /**
     * Halaman etalase / katalog makanan untuk pelanggan
     */
    public function index()
    {
        $keyword  = $this->request->getGet('q');
        $kategori = $this->request->getGet('kategori');

        $builder = $this->makananModel->orderBy('id', 'DESC');

        if (!empty($keyword)) {
            $builder = $builder->groupStart()
                ->like('nama_makanan', $keyword)
                ->orLike('kategori', $keyword)
                ->groupEnd();
        }

        if (!empty($kategori)) {
            $builder = $builder->where('kategori', $kategori);
        }

        $data = [
            'title'         => 'Warung Nusantara - Pesan Makanan Favoritmu',
            'makanan'       => $builder->findAll(),
            'kategori'      => $this->makananModel->getKategoriList(),
            'keyword'       => $keyword,
            'kategoriAktif' => $kategori,
        ];

        return view('home/index', $data);
    }
}
