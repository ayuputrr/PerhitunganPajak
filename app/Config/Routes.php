<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
<<<<<<< HEAD
    */

$routes->get('/', 'Auth::index');
$routes->get('/login/admin', 'Auth::adminLoginForm');
$routes->get('/login/pengguna', 'Auth::penggunaLoginForm');
$routes->post('/login/admin', 'Auth::dologinAdmin');
$routes->post('/login/pengguna', 'Auth::loginPengguna');
$routes->get('/pengguna/registrasi', 'Auth::registrasiForm');
$routes->post('/pengguna/registrasi', 'Auth::registrasi');
$routes->get('/logout', 'Auth::logout');

$routes->get('pegawai/dashboard', 'Pegawai::dashboard');
$routes->get('/pengguna/dashboard', 'Pengguna::Dashboard');





$routes->get('/pegawai', 'Pegawai::index');
$routes->get('/pegawai/create', 'Pegawai::create');
$routes->post('/pegawai/store', 'Pegawai::store');

$routes->get('/pegawai/hitung/(:num)', 'Pegawai::hitung/$1');
$routes->get('/pegawai/hitungTahunan/(:num)', 'Pegawai::hitungTahunan/$1');

$routes->get('/pegawai/export/(:num)', 'Pegawai::export/$1');

$routes->get('/pegawai/edit/(:num)', 'Pegawai::edit/$1'); // opsional, jika kamu membuat edit
$routes->post('/pegawai/update/(:num)', 'Pegawai::update/$1'); // opsional, jika kamu membuat update
$routes->get('/pegawai/delete/(:num)', 'Pegawai::delete/$1'); // opsional, jika kamu membuat hapus

//$routes->get('/pegawai/export_excel/(:num)', 'Pegawai::exportExcel/$1');
$routes->get('/pegawai/export_excel/(:num)', 'Pegawai::exportExcel/$1'); // Export satu pegawai
$routes->get('/pegawai/export_excel_all', 'Pegawai::exportExcelAll');    // Export semua pegawai

