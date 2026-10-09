
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer</title>
</head>
<body>
    <h1>Add New Customer</h1>

    <form action="<?= site_url('customers/create') ?>" method="post">
        <?= csrf_field() ?>

        <label for="full_name">Full Name:</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= old('full_name') ?>"
            required
        >
        <br><br>

        <label for="email">Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= old('email') ?>"
            required
        >
        <br><br>

        <button type="submit">Save Customer</button>
    </form>

    <p><a href="<?= site_url('customers') ?>">Back to Customers</a></p>
</body>
</html>