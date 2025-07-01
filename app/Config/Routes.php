<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('auth', 'Auth::index'); // Tampilkan form login
$routes->post('auth/login', 'Auth::login'); // Proses form login

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

