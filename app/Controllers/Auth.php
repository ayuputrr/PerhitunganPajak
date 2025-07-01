<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function index()
    {
        return view('login'); // tampilkan halaman login
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cari user berdasarkan username
        $user = $model->where('username', $username)->first();

        if ($user) {
            // cocokkan password (gunakan password_verify jika sudah di-hash)
            if ($user['password'] === $password) { // ganti dengan password_verify() jika hash
                // simpan data ke session
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'logged_in' => true
                ]);
                return redirect()->to('/pegawai'); // arahkan ke halaman dashboard
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
