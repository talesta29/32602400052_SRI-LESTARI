<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Dipakai setelah AuthFilter. Contoh penggunaan di Routes.php:
 *   'filter' => 'auth,role:admin,penjual'
 */
class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('gagal', 'Silakan login terlebih dahulu.');
        }

        $role = $session->get('role');

        if (!empty($arguments) && !in_array($role, $arguments, true)) {
            return redirect()->to('/')->with('gagal', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak ada aksi setelah request
    }
}
