<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Login</title>
</head>
<body>
    <h1>POS Application Login</h1>
    <p>Please log in to manage customer and user accounts.</p>

    <?php if (service('request')->getGet('logged_out') === '1'): ?>
        <p style="color: green;">
            You have been logged out successfully.
        </p>
    <?php endif; ?>

    <?php $error = session()->getFlashdata('error'); ?>
    <?php if ($error): ?>
        <p style="color: red;">
            <?= esc($error) ?>
        </p>
    <?php endif; ?>

    <?php $success = session()->getFlashdata('success'); ?>
    <?php if ($success): ?>
        <p style="color: green;">
            <?= esc($success) ?>
        </p>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label for="username">Username:</label>
            <input
                type="text"
                id="username"
                name="username"
                value="<?= esc(old('username')) ?>"
                required
                autofocus
            >
        </div>

        <br>

        <div>
            <label for="password">Password:</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </div>

        <br>

        <button type="submit">Log In</button>
    </form>
</body>
</html>
