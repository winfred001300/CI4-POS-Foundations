<!DOCTYPE html>
<html>
<head>
    <title>Customer Accounts</title>
</head>
<body>

    <h1>Customer Accounts</h1>

    <?php foreach ($customers as $customer): ?>

        <p>
            ID: <?= esc($customer['id']) ?><br>
            Name: <?= esc($customer['full_name']) ?><br>
            Email: <?= esc($customer['email']) ?><br>
            Phone: <?= esc($customer['phone']) ?>
        </p>

        <hr>

    <?php endforeach; ?>

</body>
</html>