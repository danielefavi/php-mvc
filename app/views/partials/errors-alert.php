<?php if(isset($errors) and count($errors)): ?>
    <div class="alert alert-danger my-3" role="alert">
        <h4>Some error occurred!</h4>
        <ul>
            <?php foreach ($errors as $error): ?>
                <?php if (is_string($error)): ?>
                    <li><?= $error ?></li>
                <?php elseif (is_array($error)): ?>
                    <?php foreach ($error as $errorDet): ?>
                        <li><?= $errorDet ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>

            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
