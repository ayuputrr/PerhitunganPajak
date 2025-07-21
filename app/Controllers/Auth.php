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
        if (!session()->has('show_forgot_password')) {
            session()->set('show_forgot_password', false);
        }
        return view('login/pengguna_login');
    }

    // PROSES Login Admin
   // PROSES Login Admin TANPA HASH (versi tidak aman / plaintext)
public function doLoginAdmin()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $userModel = new UserModel();
    $admin = $userModel->where('email', $email)->first();

    if (!$admin) {
        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    // ✅ Compare password polos dari input dan database
    if ($password !== $admin['password']) {
        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    // ✅ Login berhasil
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
        $captchaInput = $this->request->getPost('captcha_input');

        // Validasi captcha
        if (strtolower($captchaInput) !== strtolower(session()->get('captcha_word'))) {
            return redirect()->back()->with('error', 'Kode captcha salah.');
        }

        $model = new PenggunaModel();
        $user = $model->where('nip', $nip)->first();

        if (!$user) {
            return redirect()->to('/login/pengguna')->with('error', 'Akun tidak ditemukan.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah.');
        }

        // Login berhasil, set session dst.
        session()->set([
            'logged_in' => true,
            'nip'       => $user['nip'],
            'nama'      => $user['nama'],
            'role'      => 'pengguna',
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
            'nip'       => 'required|is_unique[pengguna.nip]',
            'nama'      => 'required',
            'password'  => 'required|min_length[6]'
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
            'nip'       => $data['nip'],
            'nama'      => $data['nama'],
            'password'  => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login/pengguna')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah logout.');
    }

    // FORM Lupa Password
    public function lupaPassword()
    {
        return view('login/lupa_password');
    }

    // Verifikasi NIP untuk reset password
    public function verifikasiNip()
    {
        $nip = $this->request->getPost('nip');

        $model = new PenggunaModel();
        $user = $model->where('nip', $nip)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'NIP tidak ditemukan.')->withInput();
        }

        session()->set('reset_nip', $nip);
        session()->set('show_forgot_password', false);

        return redirect()->to('/auth/resetPassword');
    }

    // FORM Reset Password
    public function resetPassword()
    {
        if (!session()->has('reset_nip')) {
            return redirect()->to('/auth/lupaPassword')->with('error', 'Harap masukkan NIP terlebih dahulu.');
        }
        return view('login/reset_password');
    }

    // PROSES Reset Password
    public function prosesResetPassword()
    {
        if (!session()->has('reset_nip')) {
            return redirect()->to('/auth/lupaPassword')->with('error', 'Sesi reset password tidak valid.');
        }

        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($password !== $passwordConfirm) {
            return redirect()->back()->with('error', 'Password dan konfirmasi tidak sama.')->withInput();
        }

        $model = new PenggunaModel();
        $nip = session()->get('reset_nip');
        $user = $model->where('nip', $nip)->first();

        if ($user) {
            $model->update($user['id'], [
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        }

        session()->remove('reset_nip');
        session()->set('show_forgot_password', false);

        return redirect()->to('/login/pengguna')->with('success', 'Password berhasil direset. Silakan login.');
    }
}