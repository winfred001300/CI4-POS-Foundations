<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customer Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            background: #f4f6f9;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 6px;
        }
        button, .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            background: #1769aa;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
        .error {
            color: #b00020;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Add New Customer Account</h1>
    <p>Enter the customer's information below.</p>

    <?php if (session()->getFlashdata('error')): ?>
        <p class="error">
            <?= esc(session()->getFlashdata('error')) ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul class="error">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <p><?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>

    <form action="<?= site_url('customers/create') ?>" method="post">
        <?= csrf_field() ?>

        <label for="full_name">Full Name</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= esc(old('full_name') ?? '') ?>"
            required
        >

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= esc(old('email') ?? '') ?>"
            required
        >

        <label for="phone">Phone Number</label>
        <input
            type="tel"
            id="phone"
            name="phone"
            value="<?= esc(old('phone') ?? '') ?>"
        >

        <button type="submit">Save Customer</button>
    </form>

    <a class="back-link" href="<?= site_url('customers') ?>">
        Back to Customer List
    </a>
</div>
</body>
</html>
