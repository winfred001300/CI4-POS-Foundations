<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>
<body>
    <h1>Product Management</h1>

    <p>
        <a href="<?= site_url('products/new') ?>">Add New Product</a>
    </p>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;">
            <?= esc(session()->getFlashdata('success')) ?>
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
        <p>No products found.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= esc($product['id']) ?></td>
                        <td><?= esc($product['product_name']) ?></td>
                        <td><?= esc($product['description'] ?? '') ?></td>
                        <td>₱<?= number_format((float) $product['price'], 2) ?></td>
                        <td><?= esc($product['stock_quantity']) ?></td>
                        <td>
                            <a href="<?= site_url('products/edit/' . $product['id']) ?>">
                                Edit
                            </a>

                            <form
                                action="<?= site_url('products/delete/' . $product['id']) ?>"
                                method="post"
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure you want to delete this product?');"
                            >
                                <?= csrf_field() ?>
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <hr>

    <h3>Navigation</h3>
    <p><a href="<?= site_url('customers') ?>">Customer Management</a></p>
    <p><a href="<?= site_url('users') ?>">Staff Management</a></p>
    <p><a href="<?= site_url('products') ?>">Product Management</a></p>
    <p><a href="<?= site_url('sales') ?>">Sales</a></p>
    <p><a href="<?= site_url('logout') ?>">Logout</a></p>

</body>
</html>
