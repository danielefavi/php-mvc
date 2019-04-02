<?php require(__DIR__ . '/../partials/header.php') ?>

<h1 class="title">
    Posts
    <a href="<?= get_uri('admin/posts/create') ?>" class="btn btn-success">
        <i class="fa fa-plus"></i> Create
    </a>
</h1>

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
		<tr>
			<th>ID</th>
			<th>Title</th>
            <th>Body</th>
			<th>Deleted</th>
            <th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($posts as $post): ?>
			<tr>
				<td><?= $post->data->id ?></td>
				<td><?= $post->data->title ?></td>
				<td><?= $post->data->body ?></td>
				<td><?= $post->data->deleted_at ?></td>
				<td>
					<a href="<?= $post->path('edit') ?>" class="btn btn-xs btn-danger">
						<i class="fas fa-pencil-alt"></i> Edit
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<?php require(__DIR__ . '/../partials/pagination.php') ?>


<?php require(__DIR__ . '/../partials/footer.php') ?>
