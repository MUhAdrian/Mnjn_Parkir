<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/parkir/masuk', 'Parkir::formMasuk');
$routes->post('/parkir/simpan', 'Parkir::simpanMasuk');
$routes->get('/parkir/keluar/', 'Parkir::formKeluar');
$routes->post('/parkir/selesai', 'Parkir::simpanKeluar');
$routes->get('/tarif', 'Tarif::index');
$routes->get('/tarif/edit', 'Tarif::index');
$routes->post('/tarif/update', 'Tarif::update');
$routes->post('/tarif/edit', 'Tarif::index');

$routes->get('/laporan', 'Laporan::index'); 
$routes->get('/laporan/filter', 'Laporan::filter');


$routes->get('/', 'Dashboard::index');
