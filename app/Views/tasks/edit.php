<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - Tasks for Today</title>
</head>
<body>

    <h1>Edit Task</h1>

    <p><a href="<?= site_url('tasks') ?>">Back to Task List</a></p>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <?php if (! empty($errors)): ?>
        <ul style="color: red;">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= site_url('tasks/update/' . $task['id']) ?>" method="post">
        <?= csrf_field() ?>

        <p>
            <label for="title">Task Title (required):</label><br>
            <input
                type="text"
                id="title"
                name="title"
                maxlength="150"
                value="<?= esc(old('title', $task['title'])) ?>"
                required
            >
        </p>

        <p>
            <label for="description">Description (optional):</label><br>
            <textarea
                id="description"
                name="description"
                rows="4"
                cols="40"
            ><?= esc(old('description', $task['description'] ?? '')) ?></textarea>
        </p>

        <p>
            <label for="task_date">Task Date (required):</label><br>
            <input
                type="date"
                id="task_date"
                name="task_date"
                value="<?= esc(old('task_date', $task['task_date'])) ?>"
                required
            >
        </p>

        <button type="submit">Update Task</button>
    </form>

</body>
</html>
