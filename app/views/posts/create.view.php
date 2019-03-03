<?php require(__DIR__ . '/../partials/header.php') ?>

<h1 class="title">
    Posts - Create a Post
</h1>

<?php require(__DIR__ . '/../partials/errors-alert.php') ?>

<form method="post">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" placeholder="Body" rows="10"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                Create
            </button>
        </div>
    </div>
</form>

<?php require(__DIR__ . '/../partials/footer.php') ?>
