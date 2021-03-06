<?php require(__DIR__ . '/../partials/header.php') ?>

<div class="d-flex align-items-center">
    <h1 class="title mr-auto">
        Posts - Edit a Post
    </h1>
    <div class="">
        <form method="post" action="<?= $post->path('delete') ?>">
            <button type="submit" name="action" value="delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this post???')">
                Delete
            </button>
        </form>
    </div>
</div>


<?php require(__DIR__ . '/../partials/errors-alert.php') ?>

<form method="post" action="<?= $post->path('edit') ?>">
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
        <div class="card-footer text-right">
            <button type="submit" name="action" value="update" class="btn btn-primary">
                Update
            </button>
        </div>
    </div>
</form>

<?php require(__DIR__ . '/../partials/footer.php') ?>
