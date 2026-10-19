<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Accounts</title>
</head>
<body>
    <h1>Staff Accounts</h1>

    <p>
        <a href="<?= site_url('users/new') ?>">Add New Staff Account</a>
    </p>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;">
            <?= esc(session()->getFlashdata('success')) ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul style="color: red;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (empty($users)): ?>
        <p>No staff accounts found.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['id']) ?></td>

                        <td>
                            <?php if (!empty($user['avatar'])): ?>
                                <img
                                    src="<?= base_url('uploads/' . $user['avatar']) ?>"
                                    alt="Avatar for <?= esc($user['username']) ?>"
                                    width="75"
                                    height="75"
                                    style="object-fit: cover;"
                                >
                            <?php else: ?>
                                No avatar
                            <?php endif; ?>
                        </td>

                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['full_name']) ?></td>

                        <td>
                            <a href="<?= site_url('users/edit/' . $user['id']) ?>">
                                Edit
                            </a>

                            <?php if ((int) session()->get('userId') !== (int) $user['id']): ?>
                                |
                                <form
                                    action="<?= site_url('users/delete/' . $user['id']) ?>"
                                    method="post"
                                    style="display: inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this staff account?');"
                                >
                                    <?= csrf_field() ?>

                                    <button type="submit">
                                        Delete
                                    </button>
                                </form>
                            <?php else: ?>
                                | Current Account
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p>
        <a href="<?= site_url('customers') ?>">Back to Customer Accounts</a>
    </p>
</body>
</html>
