<?php

namespace App\Controllers;

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

    // TANPA password_verify karena password tidak di-hash
    if (!$admin || $password !== $admin['password']) {
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

public function logout()
{
    session()->destroy();
    return redirect()->to('/')->with('success', 'Anda telah logout.');
}}