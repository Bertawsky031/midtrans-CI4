<?php

namespace App\Controllers;

use App\Models\ProductModel;

class CartController extends BaseController
{
    public function index()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        $productModel = new ProductModel();
        $data['cartItems'] = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $productModel->find($productId);
            if ($product) {
                $data['cartItems'][] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
                $total += $product['price'] * $quantity;
            }
        }

        $data['total'] = $total;

        return view('cart/index', $data);
    }

    public function remove($productId)
    {
        $session = session();
        $cart = $session->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $session->set('cart', $cart);
        }

        return redirect()->to('/cart');
    }
}