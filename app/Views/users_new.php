<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Staff Account</title>
</head>
<body>
    <h1>Create Staff Account</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;">
            <?= esc(session()->getFlashdata('error')) ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;">
            <?= esc(session()->getFlashdata('success')) ?>
        </p>
    <?php endif; ?>

    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('users/create') ?>"
          method="post"
          enctype="multipart/form-data">

        <?= csrf_field() ?>

        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"
                   value="<?= esc(old('username')) ?>" required>
        </div>

        <br>

        <div>
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name"
                   value="<?= esc(old('full_name')) ?>" required>
        </div>

        <br>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"
                   minlength="8" required>
            <small>Must be at least 8 characters long.</small>
        </div>

        <br>

        <div>
            <label for="avatar">Avatar (optional, JPG or PNG):</label>
            <input type="file" id="avatar" name="avatar"
                   accept=".jpg,.jpeg,.png,image/jpeg,image/png">
        </div>

        <br>

        <button type="submit">Create Staff Account</button>
    </form>

    <p><a href="<?= site_url('users') ?>">Back to Staff Accounts</a></p>
</body>
</html>
