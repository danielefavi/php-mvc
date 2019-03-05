<?php require(__DIR__ . '/partials/header.php') ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Login</h2>
                <div class="row">
                    <div class="col-md-6 mx-auto">

                        <!-- form card login -->
                        <div class="card shadow-sm p-3 mb-2 rounded">
                            <div class="card-body">
                                <?php if (isset($loginAttempt) and !$loginAttempt): ?>
                                    <h4 class="text-danger mb-3">User or Password not valid!</h4>
                                <?php endif; ?>

                                <p class="text-center">
                                    USER: <b>admin</b>
                                    <br>
                                    PASSWORD: <b>pass</b>
                                </p>

                                <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                                    <div class="form-group">
                                        <label for="uname1">Username</label>
                                        <input type="text" class="form-control form-control-lg rounded-0" name="user" id="user">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control form-control-lg rounded-0" name="password">
                                    </div>

                                    <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">
                                        Login
                                    </button>
                                </form>
                            </div> <!--/card-block-->
                        </div> <!-- /form card login -->

                    </div>
                </div> <!--/row-->
            </div> <!--/col-->
        </div> <!--/row-->
    </div> <!--/container-->

<?php require(__DIR__ . '/partials/footer.php') ?>
