<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
</head>
<body>

    <h1>User Accounts</h1>

    <?php foreach ($users as $user): ?>

        <p>
            ID: <?= $user['id'] ?><br>
            Username: <?= $user['username'] ?><br>
            Email: <?= $user['email'] ?>
        </p>

        <hr>

    <?php endforeach; ?>

</body>
</html>