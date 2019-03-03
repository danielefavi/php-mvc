<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP MVC - Login Page</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body class="bg-dark">

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-white mb-4">Login</h2>
                <div class="row">
                    <div class="col-md-6 mx-auto">

                        <!-- form card login -->
                        <div class="card rounded-0">
                            <!-- <div class="card-header">
                                <h3 class="mb-0">Login</h3>
                            </div> -->
                            <div class="card-body">
                                <?php if (isset($loginAttempt) and !$loginAttempt): ?>
                                    <h4 class="text-danger mb-3">User or Password not valid!</h4>
                                <?php endif; ?>

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

</body>
</html>
