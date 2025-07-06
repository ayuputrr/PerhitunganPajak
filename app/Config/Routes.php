<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// AUTH & LOGIN
$routes->get('/', 'Auth::index');
$routes->get('/login/admin', 'Auth::adminLoginForm');
$routes->get('/login/pengguna', 'Auth::penggunaLoginForm');
$routes->post('/login/admin', 'Auth::dologinAdmin');
$routes->post('/login/pengguna', 'Auth::loginPengguna');
$routes->get('/pengguna/registrasi', 'Auth::registrasiForm');
$routes->post('/pengguna/registrasi', 'Auth::registrasi');
$routes->get('/pengguna/logout', 'Auth::logout');
$routes->get('/pegawai/logout', 'Auth::logout');

// DASHBOARD & ARSIP PENGGUNA
$routes->get('/pengguna/dashboard', 'Pengguna::dashboard');
$routes->get('/pengguna/arsip', 'Pengguna::arsip');

// LAPORAN & PDF PENGGUNA
$routes->get('/pengguna/export_pdf', 'Pengguna::export_pdf');

// NOTIFIKASI PENGGUNA
$routes->post('/pengguna/notifikasi_dibaca', 'Pengguna::tandaiNotifikasiDibaca');
$routes->post('/pengguna/hapus_notifikasi/(:num)', 'Pengguna::hapusNotifikasi/$1');

// DASHBOARD PEGAWAI (ADMIN)
$routes->get('/pegawai/dashboard', 'Pegawai::dashboard');
$routes->get('/pegawai', 'Pegawai::dashboard'); // Alias untuk dashboard
$routes->get('/pegawai/create', 'Pegawai::create');
$routes->post('/pegawai/store', 'Pegawai::store');

// NOTIFIKASI PEGAWAI (ADMIN)
$routes->post('pegawai/kirimnotifikasi', 'Pegawai::kirimNotifikasi');

// HITUNG & DETAIL PAJAK PEGAWAI
$routes->get('/pegawai/hitung/(:num)', 'Pegawai::hitung/$1');
$routes->get('/pegawai/hitungTahunan/(:num)', 'Pegawai::hitungTahunan/$1');

// EXPORT & ARSIP PEGAWAI
$routes->get('/pegawai/export/(:num)', 'Pegawai::export/$1');
$routes->get('/pegawai/export_excel/(:num)', 'Pegawai::exportExcel/$1'); // Export satu pegawai
$routes->get('/pegawai/export_excel_all', 'Pegawai::exportExcelAll');    // Export semua pegawai

// CRUD PEGAWAI (ADMIN)
$routes->get('/pegawai/edit/(:num)', 'Pegawai::edit/$1');
$routes->post('/pegawai/update/(:num)', 'Pegawai::update/$1');
$routes->get('/pegawai/delete/(:num)', 'Pegawai::delete/$1');

// LAPORAN TAHUNAN & BULANAN
$routes->get('/laporan/tahunan', 'Laporan::tahunan');
$routes->get('/laporan/export_excel_tahunan', 'Laporan::export_excel_tahunan');
$routes->get('/laporan/bulanan', 'Laporan::bulanan');
$routes->get('/laporan/export_excel_bulanan', 'Laporan::export_excel_bulanan');

$routes->get('laporan', 'Laporan::bulanan');
$routes->get('pegawai/detail/(:num)', 'Pegawai::detail/$1');

$routes->get('/pengguna/edit_profil', 'Pengguna::editProfil');
$routes->post('/pengguna/update_profil', 'Pengguna::updateProfil');
$routes->get('/pengguna/edit_password', 'Pengguna::editPassword');
$routes->post('/pengguna/update_password', 'Pengguna::updatePassword');
$routes->get('/pengguna/profil', 'Pengguna::profil');

$routes->get('/pengguna/arsip_tahunan', 'Pengguna::arsipTahunan');
$routes->get('pengguna/exportPdfTahunan/(:num)', 'Pengguna::exportPdfTahunan/$1');