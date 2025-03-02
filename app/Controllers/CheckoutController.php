<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;
use Config\Midtrans;
use Midtrans\Snap;

class CheckoutController extends BaseController
{
    public function index()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        // Jika keranjang kosong, redirect ke halaman produk
        if (empty($cart)) {
            return redirect()->to('/');
        }

        $productModel = new ProductModel();
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $productModel->find($productId);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
                $total += $product['price'] * $quantity;
            }
        }

        $data['cartItems'] = $cartItems;
        $data['total'] = $total;

        // Buat order ID unik
        $orderId = uniqid();

        // Simpan data pesanan ke database dengan status awal "pending"
        $orderModel = new OrderModel();
        $orderModel->insert([
            'order_id' => $orderId,
            'gross_amount' => $total,
            'status' => 'pending',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        // Konfigurasi Midtrans
        $midtransConfig = config('Midtrans');
        \Midtrans\Config::$serverKey = $midtransConfig->serverKey;  // Gunakan ->
        \Midtrans\Config::$isProduction = $midtransConfig->isProduction; // Gunakan ->
        \Midtrans\Config::$isSanitized = $midtransConfig->isSanitized; // Gunakan ->
        \Midtrans\Config::$is3ds = $midtransConfig->is3ds; // Gunakan ->

        // Parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int)$total,
            ],
            'customer_details' => [
                'first_name' => 'John', // Ganti data customer
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '081234567890',
            ],
        ];

        try {
            // Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);
    
            // Kirim data ke view
            $data['snapToken'] = $snapToken;
            $data['orderId'] = $orderId;
            return view('checkout/index', $data);
    
        } catch (\Exception $e) {
            // Tangani error
            echo $e->getMessage();
        }
    }
}