<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar ">
    <nav class="navbar navbar-expand-sm bg-primary fixed-top">

        <?php if(auth()->isLogged()): ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= get_uri('admin/home') ?>" class="nav-link <?= link_is_active('admin/home', 'active') ?>">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= get_uri('admin/posts/index') ?>" class="nav-link <?= link_is_active('admin/posts*', 'active') ?>">
                        <i class="fas fa-file-alt"></i> Posts
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= get_uri('admin/tasks') ?>" class="nav-link <?= link_is_active('admin/tasks*', 'active') ?>">
                        <i class="fas fa-list"></i> Tasks
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="<?= get_uri('logout') ?>" method="post">
                        <button class="btn btn-outline-light" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        <?php else: ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= get_uri('/') ?>" class="nav-link <?= link_is_active('/', 'active') ?>">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= get_uri('login') ?>" class="nav-link <?= link_is_active('login', 'active') ?>">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </nav>
</header>
