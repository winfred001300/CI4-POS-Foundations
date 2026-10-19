<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
</head>
<body>
    <h1>Add New Product</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul style="color: red;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= site_url('products/create') ?>" method="post">
        <?= csrf_field() ?>

        <p>
            <label for="product_name">Product Name:</label><br>
            <input type="text" id="product_name"
                   name="product_name"
                   value="<?= esc(old('product_name') ?? '') ?>"
                   required>
        </p>

        <p>
            <label for="description">Description:</label><br>
            <textarea id="description"
                      name="description"><?= esc(old('description') ?? '') ?></textarea>
        </p>

        <p>
            <label for="price">Price:</label><br>
            <input type="number" id="price" name="price"
                   step="0.01" min="0"
                   value="<?= esc(old('price') ?? '') ?>"
                   required>
        </p>

        <p>
            <label for="stock_quantity">Stock Quantity:</label><br>
            <input type="number" id="stock_quantity"
                   name="stock_quantity"
                   min="0" step="1"
                   value="<?= esc(old('stock_quantity') ?? '') ?>"
                   required>
        </p>

        <button type="submit">Add Product</button>
    </form>

    <p><a href="<?= site_url('products') ?>">Cancel</a></p>
</body>
</html>
