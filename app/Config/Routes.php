<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('ProductController'); // Ubah default controller
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // Matikan auto route agar lebih eksplisit

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default route.
$routes->get('/', 'ProductController::index'); // Menampilkan daftar produk
$routes->get('products/addtocart/(:num)', 'ProductController::addToCart/$1'); // Tambah ke keranjang
$routes->get('cart', 'CartController::index'); // Menampilkan keranjang
$routes->get('cart/remove/(:num)', 'CartController::remove/$1'); // Menghapus item dari keranjang
$routes->get('checkout', 'CheckoutController::index'); // Menangani proses checkout
$routes->post('payment/callback', 'PaymentController::callback'); // Menerima callback dari Midtrans