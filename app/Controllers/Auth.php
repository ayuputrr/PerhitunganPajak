<?php

namespace App\Controllers;
<<<<<<< HEAD

use App\Models\UserModel;
use App\Models\PenggunaModel;
use App\Models\PegawaiModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    // Halaman utama login
    public function index()
    {
        return view('login/index');
    }

    // FORM Login Admin
    public function adminLoginForm()
    {
        return view('login/admin_login');
    }

    // FORM Login Pengguna
    public function penggunaLoginForm()
    {
        return view('login/pengguna_login');
    }

    // PROSES Login Admin
    public function doLoginAdmin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $admin = $userModel->where('email', $email)->first();

        if (!$admin || !password_verify($password, $admin['password'])) {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }

        session()->set([
            'logged_in' => true,
            'email'     => $admin['email'],
            'role'      => 'admin'
        ]);

        return redirect()->to('/pegawai/dashboard');
    }

    // PROSES Login Pengguna
    public function loginPengguna()
    {
        $nip = $this->request->getPost('nip');
        $password = $this->request->getPost('password');

        $model = new PenggunaModel();
        $user = $model->where('nip', $nip)->first();

        if (!$user) {
            return redirect()->to('/login/pengguna')->with('error', 'Akun tidak ditemukan. Silakan daftar.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah.');
        }

        session()->set([
            'logged_in' => true,
            'nip'       => $user['nip'],
            'nama'      => $user['nama'],
            'role'      => 'pengguna'
        ]);

        return redirect()->to('/pengguna/dashboard');
    }

    // FORM Registrasi Pengguna
    public function registrasiForm()
    {
        return view('login/registrasi');
    }

    // PROSES Registrasi Pengguna
    public function registrasi()
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $rules = [
            'nip'      => 'required|is_unique[pengguna.nip]',
            'nama'     => 'required',
            'password' => 'required|min_length[6]'
        ];

        if (!$validation->setRules($rules)->run($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Cek apakah NIP ada di tabel pegawai
        $pegawaiModel = new PegawaiModel();
        $pegawai = $pegawaiModel->where('nip', $data['nip'])->first();

        if (!$pegawai) {
            return redirect()->back()->withInput()->with('error', 'NIP tidak ditemukan di data pegawai.');
        }

        $penggunaModel = new PenggunaModel();
        $penggunaModel->insert([
            'nip'      => $data['nip'],
            'nama'     => $data['nama'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login/pengguna')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // LOGOUT semua peran
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
=======
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
>>>>>>> 1dae537324ce403d4bb1015628acd988641ee27a
    }
}
