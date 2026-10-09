
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
</head>
<body>
    <h1>Add New User</h1>

    <form action="<?= site_url('users/create') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username:</label>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= old('username') ?>"
            required
        >
        <br><br>

        <label for="full_name">Full Name:</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= old('full_name') ?>"
            required
        >
        <br><br>

        <button type="submit">Save User</button>
    </form>

    <p><a href="<?= site_url('users') ?>">Back to Users</a></p>
</body>
</html>