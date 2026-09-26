<!DOCTYPE html>
<html>
<head>
    <title>Customer Accounts</title>
</head>
<body>

    <h1>Customer Accounts</h1>

    <?php foreach ($customers as $customer): ?>

        <p>
            ID: <?= $customer['id'] ?><br>
            Name: <?= $customer['name'] ?><br>
            Email: <?= $customer['email'] ?>
        </p>

        <hr>

    <?php endforeach; ?>

</body>
</html>