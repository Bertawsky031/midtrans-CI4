<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <p>Order ID: <?= esc($orderId) ?></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?= esc($item['product']['name']) ?></td>
                        <td><?= number_format($item['product']['price'], 0, ',', '.') ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['product']['price'] * $item['quantity'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td><?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>
        <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
    </div>

    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="<?= config('Midtrans')->clientKey ?>"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('<?= $snapToken ?>', {
                onSuccess: function(result) {
                    console.log(result);
                    alert('Pembayaran Berhasil!');
                    // Redirect ke halaman sukses atau tampilkan pesan sukses
                },
                onPending: function(result) {
                    console.log(result);
                    alert('Menunggu Pembayaran!');
                    // Redirect ke halaman pending atau tampilkan pesan pending
                },
                onError: function(result) {
                    console.log(result);
                    alert('Pembayaran Gagal!');
                    // Redirect ke halaman gagal atau tampilkan pesan gagal
                },
                onClose: function() {
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran.');
                }
            });
        });
    </script>
</body>
</html>