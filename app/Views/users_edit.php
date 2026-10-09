<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form
        action="<?= site_url('users/update/' . $user['id']) ?>"
        method="post"
        enctype="multipart/form-data"
    >
        <?= csrf_field() ?>

        <label for="username">Username:</label>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= esc(old('username', $user['username'])) ?>"
            required
        >
        <br><br>

        <label for="full_name">Full Name:</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= esc(old('full_name', $user['full_name'])) ?>"
            required
        >
        <br><br>

        <?php if (!empty($user['avatar'])): ?>
            <p>Current Avatar:</p>
            <img
                src="<?= base_url('uploads/' . $user['avatar']) ?>"
                alt="Current user avatar"
                width="150"
                height="150"
            >
            <br><br>
        <?php endif; ?>

        <label for="avatar">Upload Avatar (JPG or PNG, maximum 2 MB):</label>
        <input
            type="file"
            id="avatar"
            name="avatar"
            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
        >
        <br><br>

        <button type="submit">Update User</button>
    </form>

    <p>
        <a href="<?= site_url('users') ?>">Back to Users</a>
    </p>
</body>
</html>
