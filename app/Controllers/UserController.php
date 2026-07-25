<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Manajemen User - khusus Admin.
 * Admin dapat melihat, menambah, mengubah role/password, dan menghapus akun
 * Admin, Penjual, maupun Pembeli.
 */
class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * READ - daftar semua user
     */
    public function index()
    {
        $keyword = $this->request->getGet('q');
        $role    = $this->request->getGet('role');

        $builder = $this->userModel->orderBy('id', 'ASC');

        if (!empty($keyword)) {
            $builder = $builder->groupStart()
                ->like('nama', $keyword)
                ->orLike('username', $keyword)
                ->orLike('email', $keyword)
                ->groupEnd();
        }

        if (!empty($role)) {
            $builder = $builder->where('role', $role);
        }

        $data = [
            'title'     => 'Manajemen User',
            'users'     => $builder->findAll(),
            'keyword'   => $keyword,
            'roleAktif' => $role,
            'ringkasan' => $this->userModel->jumlahPerRole(),
        ];

        return view('user/index', $data);
    }

    /**
     * CREATE - form tambah user baru
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah User',
        ];

        return view('user/create', $data);
    }

    /**
     * CREATE - simpan user baru (admin bisa memilih role apa saja)
     */
    public function store()
    {
        $rules = [
            'nama'     => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|in_list[admin,penjual,pembeli]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->buatUser([
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role'),
            'no_hp'    => $this->request->getPost('no_hp'),
            'alamat'   => $this->request->getPost('alamat'),
        ]);

        return redirect()->to('/user')->with('sukses', 'User baru berhasil ditambahkan.');
    }

    /**
     * UPDATE - form edit user
     */
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('gagal', 'User tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit User',
            'user'  => $user,
        ];

        return view('user/edit', $data);
    }

    /**
     * UPDATE - simpan perubahan user (role, data diri, & password opsional)
     */
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('gagal', 'User tidak ditemukan.');
        }

        // Mencegah admin terakhir menurunkan role dirinya sendiri hingga
        // tidak ada admin tersisa di sistem.
        if ((int) $id === (int) session()->get('user_id') && $this->request->getPost('role') !== 'admin') {
            $jumlahAdmin = $this->userModel->where('role', 'admin')->countAllResults();
            if ($jumlahAdmin <= 1) {
                return redirect()->back()->with('gagal', 'Tidak bisa mengubah role akun ini karena merupakan satu-satunya Admin.');
            }
        }

        $rules = [
            'nama'     => 'required|min_length[3]|max_length[100]',
            'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
            'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
            'password' => 'permit_empty|min_length[6]',
            'role'     => 'required|in_list[admin,penjual,pembeli]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->perbaruiUser($id, [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role'),
            'no_hp'    => $this->request->getPost('no_hp'),
            'alamat'   => $this->request->getPost('alamat'),
        ]);

        // Jika admin mengubah datanya sendiri, sinkronkan session agar tampilan navbar ikut berubah.
        if ((int) $id === (int) session()->get('user_id')) {
            session()->set([
                'nama' => $this->request->getPost('nama'),
                'role' => $this->request->getPost('role'),
            ]);
        }

        return redirect()->to('/user')->with('sukses', 'Data user berhasil diperbarui.');
    }

    /**
     * DELETE - hapus user
     */
    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('gagal', 'User tidak ditemukan.');
        }

        if ((int) $id === (int) session()->get('user_id')) {
            return redirect()->to('/user')->with('gagal', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        if ($user['role'] === 'admin') {
            $jumlahAdmin = $this->userModel->where('role', 'admin')->countAllResults();
            if ($jumlahAdmin <= 1) {
                return redirect()->to('/user')->with('gagal', 'Tidak bisa menghapus satu-satunya akun Admin.');
            }
        }

        $this->userModel->delete($id);

        return redirect()->to('/user')->with('sukses', 'User berhasil dihapus.');
    }
}
