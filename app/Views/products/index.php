<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Produk</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= $product['image'] ? $product['image'] : 'https://via.placeholder.com/300x200' ?>" class="card-img-top" alt="<?= $product['name'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($product['name']) ?></h5>
                            <p class="card-text"><?= esc(substr($product['description'], 0, 100)) ?>...</p>
                            <p class="card-text">Harga: <?= number_format($product['price'], 0, ',', '.') ?></p>
                            <a href="<?= base_url('products/addtocart/' . $product['id']) ?>" class="btn btn-primary">Tambahkan ke Keranjang</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>