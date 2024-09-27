<h2>Your Todos</h2>
<a href="/todos/create">Create New Todo</a>
<ul>
    <?php foreach ($todos as $todo): ?>
        <li>
            <?= $todo['task']; ?> - <?= $todo['status']; ?>
            <form method="post" action="/todos/update/<?= $todo['id']; ?>" style="display:inline;">
                <input type="hidden" name="status" value="<?= $todo['status'] === 'pending' ? 'completed' : 'pending'; ?>">
                <button type="submit"><?= $todo['status'] === 'pending' ? 'Mark as Completed' : 'Mark as Pending'; ?></button>
            </form>
            <form method="post" action="/todos/delete/<?= $todo['id']; ?>" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this todo?');">
                <button type="submit">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
