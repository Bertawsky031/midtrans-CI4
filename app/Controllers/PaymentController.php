<?php

namespace App\Controllers;

use App\Models\OrderModel;
use Config\Midtrans;
use CodeIgniter\API\ResponseTrait;

class PaymentController extends BaseController
{
    use ResponseTrait;

    public function callback()
    {
        // Ambil data JSON yang dikirim oleh Midtrans
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Log data callback (penting untuk debugging)
        log_message('info', 'Midtrans Callback: ' . json_encode($data));

        // Sangat Penting: Validasi signature key
        $signatureKey = hash('sha512', $data['order_id'] . $data['status_code'] . $data['gross_amount'] . config('Midtrans')['serverKey']);
        if ($signatureKey !== $data['signature_key']) {
            log_message('error', 'Invalid signature key!');
            return $this->failUnauthorized('Invalid signature key'); // HTTP 401 Unauthorized
        }

        // Dapatkan order ID dari data callback
        $orderId = $data['order_id'];

        // Dapatkan status transaksi dari data callback
        $transactionStatus = $data['transaction_status'];
        // $paymentType = $data['payment_type']; // Tidak digunakan dalam contoh ini
        // $fraudStatus = $data['fraud_status']; // Tidak digunakan dalam contoh ini

        // Log status transaksi
        log_message('info', "Order ID $orderId: transaction status = " . $transactionStatus);

        // Cari order di database berdasarkan order ID
        $orderModel = new OrderModel();
        $order = $orderModel->where('order_id', $orderId)->first();

        if (!$order) {
            log_message('error', "Order not found: " . $orderId);
            return $this->failNotFound('Order not found'); // HTTP 404 Not Found
        }

        // Perbarui status order di database berdasarkan status transaksi yang diterima dari Midtrans
        $orderData = ['status' => $transactionStatus]; // Gunakan status dari Midtrans langsung

        $orderModel->update($order['id'], $orderData);

        // Kirimkan respons HTTP 200 OK ke Midtrans
        $response = [
            'status' => 'OK',
            'message' => 'Callback received',
        ];
        return $this->respond($response, 200); // HTTP 200 OK
    }
}