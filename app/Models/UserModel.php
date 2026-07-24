<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nama',
        'username',
        'email',
        'password',
        'role',
        'no_hp',
        'alamat',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama'     => 'required|min_length[3]|max_length[100]',
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,{id}]',
        'email'    => 'required|valid_email|is_unique[users.email,id,{id}]',
        'role'     => 'required|in_list[admin,penjual,pembeli]',
    ];

    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Username sudah digunakan, silakan pilih yang lain.',
        ],
        'email' => [
            'is_unique'   => 'Email sudah terdaftar, silakan gunakan email lain.',
            'valid_email' => 'Format email tidak valid.',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Simpan user baru dengan password yang sudah di-hash.
     */
    public function daftarkan(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->insert($data);
    }

    public function cariByUsernameAtauEmail(string $identitas)
    {
        return $this->groupStart()
            ->where('username', $identitas)
            ->orWhere('email', $identitas)
            ->groupEnd()
            ->first();
    }

    /**
     * Dipakai oleh Admin (Manajemen User) untuk membuat akun baru
     * dengan role bebas (admin/penjual/pembeli).
     */
    public function buatUser(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->insert($data);
    }

    /**
     * Dipakai oleh Admin (Manajemen User) untuk memperbarui akun.
     * Password bersifat opsional - jika kosong, password lama dipertahankan.
     */
    public function perbaruiUser($id, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        return $this->update($id, $data);
    }

    /**
     * Ringkasan jumlah user per role, dipakai di dashboard Manajemen User.
     */
    public function jumlahPerRole(): array
    {
        $hasil = $this->select('role, COUNT(*) as total')
            ->groupBy('role')
            ->findAll();

        $ringkasan = ['admin' => 0, 'penjual' => 0, 'pembeli' => 0];
        foreach ($hasil as $row) {
            $ringkasan[$row['role']] = (int) $row['total'];
        }

        return $ringkasan;
    }
}
