<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Sale</title>
</head>
<body>

    <h1>Record a Sale</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;">
            <?= esc(session()->getFlashdata('error')) ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul style="color: red;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (empty($products)): ?>
        <p>No products are currently in stock. Add stock before recording a sale.</p>
    <?php else: ?>

        <form action="<?= site_url('sales/create') ?>" method="post">
            <?= csrf_field() ?>

            <p>
                <label for="product_id">Select Product:</label><br>
                <select name="product_id" id="product_id" required>
                    <option value="">-- Choose a product --</option>

                    <?php foreach ($products as $product): ?>
                        <option
                            value="<?= esc($product['id']) ?>"
                            <?= old('product_id') == $product['id'] ? 'selected' : '' ?>
                        >
                            <?= esc($product['product_name']) ?>
                            — ₱<?= number_format((float) $product['price'], 2) ?>
                            (Stock: <?= esc($product['stock_quantity']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p>
                <label for="quantity">Quantity:</label><br>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    min="1"
                    step="1"
                    value="<?= esc(old('quantity') ?? '1') ?>"
                    required
                >
            </p>

            <button type="submit">Record Sale</button>
        </form>

    <?php endif; ?>

    <p><a href="<?= site_url('products') ?>">Product Management</a></p>
    <p><a href="<?= site_url('sales/history') ?>">Sales History</a></p>
    <p><a href="<?= site_url('logout') ?>">Logout</a></p>

</body>
</html>