<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
</head>
<body>

    <h1>User Accounts</h1>

    <?php foreach ($users as $user): ?>

        <p>
            ID: <?= esc($user['id']) ?><br>
            Username: <?= esc($user['username']) ?><br>
            Full Name: <?= esc($user['full_name']) ?>
        </p>

        <hr>

    <?php endforeach; ?>

</body>
</html>