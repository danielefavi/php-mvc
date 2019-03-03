<?php require(__DIR__ . '/../partials/header.php') ?>

<h1 class="title">
    Posts - Edit a Post
</h1>

<?php require(__DIR__ . '/../partials/errors-alert.php') ?>

<form method="post">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" value="<?= $post->data->title ?>">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" placeholder="Body" rows="10"><?= $post->data->body ?></textarea>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" name="action" value="delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this post???')">
                        Delete
                    </button>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" name="action" value="update" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php require(__DIR__ . '/../partials/footer.php') ?>
