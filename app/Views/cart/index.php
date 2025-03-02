<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Keranjang Belanja</h1>
        <?php if (empty($cartItems)): ?>
            <p>Keranjang belanja Anda kosong.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= esc($item['product']['name']) ?></td>
                            <td><?= number_format($item['product']['price'], 0, ',', '.') ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['product']['price'] * $item['quantity'], 0, ',', '.') ?></td>
                            <td>
                                <a href="<?= base_url('cart/remove/' . $item['product']['id']) ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?= number_format($total, 0, ',', '.') ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <a href="<?= base_url('checkout') ?>" class="btn btn-primary">Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>