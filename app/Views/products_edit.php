<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>

    <h1>Edit Product</h1>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <?php if (!empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form
        action="<?= site_url('products/update/' . $product['id']) ?>"
        method="post"
    >
        <?= csrf_field() ?>

        <p>
            <label for="product_name">Product Name:</label><br>
            <input
                type="text"
                id="product_name"
                name="product_name"
                maxlength="150"
                value="<?= esc(old('product_name', $product['product_name'])) ?>"
                required
            >
        </p>

        <p>
            <label for="description">Brief Description:</label><br>
            <textarea
                id="description"
                name="description"
                rows="4"
                cols="40"
            ><?= esc(old('description', $product['description'] ?? '')) ?></textarea>
        </p>

        <p>
            <label for="price">Price (₱):</label><br>
            <input
                type="number"
                id="price"
                name="price"
                min="0"
                step="0.01"
                value="<?= esc(old('price', $product['price'])) ?>"
                required
            >
        </p>

        <p>
            <label for="stock_quantity">Stock Quantity:</label><br>
            <input
                type="number"
                id="stock_quantity"
                name="stock_quantity"
                min="0"
                step="1"
                value="<?= esc(old('stock_quantity', $product['stock_quantity'])) ?>"
                required
            >
        </p>

        <button type="submit">Update Product</button>
        <a href="<?= site_url('products') ?>">Cancel</a>
    </form>

</body>
</html>
