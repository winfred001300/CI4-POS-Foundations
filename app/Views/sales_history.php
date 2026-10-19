<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History</title>
</head>
<body>

    <h1>Sales History</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;">
            <?= esc(session()->getFlashdata('success')) ?>
        </p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>Date</th>
                <th>Products Sold</th>
                <th>Total Amount</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($sales)): ?>
                <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td><?= esc($sale['id']) ?></td>
                        <td><?= esc($sale['sale_date']) ?></td>
                        <td>
                            <?php
                            $items = $itemsBySale[$sale['id']] ?? [];
                            ?>

                            <?php foreach ($items as $item): ?>
                                Product ID: <?= esc($item['product_id']) ?>
                                — Quantity: <?= esc($item['quantity']) ?>
                                — Unit Price: ₱<?= number_format((float) $item['unit_price'], 2) ?>
                                — Subtotal: ₱<?= number_format((float) $item['subtotal'], 2) ?>
                                <br>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            ₱<?= number_format((float) $sale['total_amount'], 2) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No sales have been recorded yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><a href="<?= site_url('sales') ?>">Record Another Sale</a></p>
    <p><a href="<?= site_url('products') ?>">Product Management</a></p>
    <p><a href="<?= site_url('customers') ?>">Customer Accounts</a></p>
    <p><a href="<?= site_url('users') ?>">Staff Accounts</a></p>
    <p><a href="<?= site_url('logout') ?>">Logout</a></p>

</body>
</html>
