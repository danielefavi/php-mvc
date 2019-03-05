<?php require(__DIR__ . '/../partials/header.php') ?>

<h1 class="title">
    Tasks
</h1>

<?php require(__DIR__ . '/../partials/errors-alert.php') ?>

<form method="post">
    <div class="card">
        <div class="card-header">
            Task List
        </div>
        <div class="card-body">
            <?php if($tasks): ?>
                <ul class="tasks">
                    <?php foreach ($tasks as $task): ?>
                        <li>
                            <input type="checkbox" <?= $task->isCompleted('checked') ?> name="tasks[<?= $task->getId() ?>]">
                            <span class="<?= $task->isCompleted('is-completed') ?>">
                                <?= $task->data->task ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center py-3">
                    No tasks to display
                </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary" name="action" value="save">
            <i class="fas fa-save"></i> Save
        </button>
    </div>

    <div class="card my-5">
        <div class="card-header">
            Create a new task
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="task">Task</label>
                <input type="text" name="task" class="form-control" placeholder="Task">
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary" name="action" value="add_new">
                <i class="fas fa-plus"></i> Add to the list
            </button>
        </div>
    </div>
</form>

<?php require(__DIR__ . '/../partials/footer.php') ?>
