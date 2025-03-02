<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();

        return view('products/index', $data);
    }

    public function addToCart($productId)
    {
    $session = session();
    $cart = $session->get('cart') ?? []; // Ambil keranjang dari session atau buat array kosong

    // Periksa apakah produk sudah ada di keranjang
    if (isset($cart[$productId])) {
        $cart[$productId]++; // Tambah quantity
    } else {
        $cart[$productId] = 1; // Tambah produk baru ke keranjang
    }

    $session->set('cart', $cart); // Simpan keranjang ke session

    return redirect()->to('/cart'); // Redirect ke halaman keranjang
    }
}