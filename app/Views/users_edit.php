<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Account</title>
</head>
<body>
    <h1>Edit Staff Account</h1>

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
            maxlength="50"
            required
        >
        <br><br>

        <label for="full_name">Full Name:</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= esc(old('full_name', $user['full_name'])) ?>"
            maxlength="100"
            required
        >
        <br><br>

        <label for="password">New Password (leave blank to keep the current password):</label>
        <input
            type="password"
            id="password"
            name="password"
            minlength="8"
            autocomplete="new-password"
        >
        <br><br>

        <?php if (!empty($user['avatar'])): ?>
            <p>Current Avatar:</p>
            <img
                src="<?= base_url('uploads/' . $user['avatar']) ?>"
                alt="Current staff avatar"
                width="150"
                height="150"
            >
            <br><br>
        <?php else: ?>
            <p>No avatar uploaded yet.</p>
        <?php endif; ?>

        <label for="avatar">New Avatar (JPG or PNG, maximum 2 MB):</label>
        <input
            type="file"
            id="avatar"
            name="avatar"
            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
        >
        <br><br>

        <button type="submit">Update Staff Account</button>
    </form>

    <p>
        <a href="<?= site_url('users') ?>">Back to Staff Accounts</a>
    </p>
</body>
</html>
