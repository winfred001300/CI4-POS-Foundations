<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
</head>
<body>
    <h1>User Accounts</h1>

    <p>
        <a href="<?= site_url('users/new') ?>">Add New User</a>
    </p>

    <?php if (session()->getFlashdata('success')): ?>
        <p><?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['id']) ?></td>

                    <td>
                        <?php if (!empty($user['avatar'])): ?>
                            <img
                                src="<?= base_url('uploads/' . esc($user['avatar'])) ?>"
                                alt="Avatar for <?= esc($user['username']) ?>"
                                width="75"
                                height="75"
                                style="object-fit: cover;"
                            >
                        <?php else: ?>
                            <span>No avatar</span>
                        <?php endif; ?>
                    </td>

                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>

                    <td>
                        <a href="<?= site_url('users/edit/' . $user['id']) ?>">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
