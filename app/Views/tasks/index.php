<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List - Tasks for Today</title>
</head>
<body>

    <h1>Tasks for Today Management System</h1>

    <nav>
        <a href="<?= site_url('home/view') ?>">Welcome</a> |
        <a href="<?= site_url('tasks') ?>">Task List</a> |
        <a href="<?= site_url('profile') ?>">Profile</a> |
        <a href="<?= site_url('about') ?>">About</a>
    </nav>

    <hr>

    <h2>Your Active Tasks</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;">
            <?= esc(session()->getFlashdata('success')) ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;">
            <?= esc(session()->getFlashdata('error')) ?>
        </p>
    <?php endif; ?>

    <?php if (empty($tasks)): ?>
        <p>No active tasks have been added yet.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Task Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= esc($task['title']) ?></td>

                        <td><?= esc($task['description'] ?? '') ?></td>

                        <td><?= esc($task['task_date']) ?></td>

                        <td>
                            <a href="<?= site_url('tasks/edit/' . $task['id']) ?>">
                                Edit
                            </a>

                            |

                            <form
                                action="<?= site_url('tasks/archive/' . $task['id']) ?>"
                                method="post"
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure you want to archive this task?');"
                            >
                                <?= csrf_field() ?>

                                <button type="submit">Archive</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p>
        <a href="<?= site_url('tasks/new') ?>">Create a New Task</a>
    </p>

    <?php if (session()->get('isLoggedIn')): ?>
        <p>
            Logged in as:
            <strong><?= esc(session()->get('username')) ?></strong>
        </p>

        <p>
            <a href="<?= site_url('logout') ?>">Log Out</a>
        </p>
    <?php else: ?>
        <p>
            <a href="<?= site_url('login') ?>">Log In to Manage Tasks</a>
        </p>
    <?php endif; ?>

</body>
</html>
