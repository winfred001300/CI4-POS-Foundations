```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= site_url('customers/update/' . $customer['id']) ?>" method="post">
        <?= csrf_field() ?>

        <label for="full_name">Full Name:</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= esc(old('full_name', $customer['full_name'])) ?>"
            required
        >
        <br><br>

        <label for="email">Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= esc(old('email', $customer['email'])) ?>"
            required
        >
        <br><br>

        <button type="submit">Update Customer</button>
    </form>

    <p>
        <a href="<?= site_url('customers') ?>">Back to Customers</a>
    </p>
</body>
</html>
```
