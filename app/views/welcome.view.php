<?php require(__DIR__ . '/partials/header.php') ?>

    <h1 class="text-center mt-5 py-5">
        Welcome to PHP-MVC
    </h1>
    <p class="text-center">
        <a href="https://github.com/danielefavi/php-mvc" class="mr-5" target="_blank">
            <i class="fab fa-github"></i> GitHub
        </a>
        <a href="https://github.com/danielefavi/php-mvc/blob/master/README.md" class="mr-5" target="_blank">
            <i class="fa fa-play-circle"></i> Quickstart
        </a>
        <a href="<?= get_uri('login') ?>">
            <i class="fa fa-rocket"></i> Demo
        </a>
    </p>

<?php require(__DIR__ . '/partials/footer.php') ?>
