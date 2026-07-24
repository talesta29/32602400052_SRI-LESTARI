<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Tampilkan form login
     */
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('auth/login', ['title' => 'Login']);
    }

    /**
     * Proses login
     */
    public function prosesLogin()
    {
        $rules = [
            'identitas' => 'required',
            'password'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $identitas = $this->request->getPost('identitas');
        $password  = $this->request->getPost('password');

        $user = $this->userModel->cariByUsernameAtauEmail($identitas);

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('gagal', 'Username/email atau password salah.');
        }

        session()->set([
            'user_id'   => $user['id'],
            'nama'      => $user['nama'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true,
        ]);

        switch ($user['role']) {
            case 'admin':
                return redirect()->to('/makanan')->with('sukses', 'Selamat datang, ' . $user['nama'] . '!');
            case 'penjual':
                return redirect()->to('/makanan')->with('sukses', 'Selamat datang, ' . $user['nama'] . '!');
            default:
                return redirect()->to('/')->with('sukses', 'Selamat datang, ' . $user['nama'] . '!');
        }
    }

    /**
     * Tampilkan form registrasi (untuk role penjual & pembeli)
     */
    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('auth/register', ['title' => 'Buat Akun']);
    }

    /**
     * Proses registrasi akun baru
     */
    public function prosesRegister()
    {
        $rules = [
            'nama'             => 'required|min_length[3]|max_length[100]',
            'username'         => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'konfirmasi_password' => 'required|matches[password]',
            'role'             => 'required|in_list[penjual,pembeli]',
        ];

        $messages = [
            'konfirmasi_password' => [
                'matches' => 'Konfirmasi password tidak sama dengan password.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->daftarkan([
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role'),
            'no_hp'    => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('/login')->with('sukses', 'Akun berhasil dibuat. Silakan login.');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('sukses', 'Anda telah logout.');
    }
}
