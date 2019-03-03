<?php if(isset($errors) and count($errors)): ?>
    <div class="alert alert-danger my-3" role="alert">
        <h4>Some error occurred!</h4>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
