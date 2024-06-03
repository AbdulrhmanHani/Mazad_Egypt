<?php require_once("../app.php");

if ($session->has("admin")) {
    $request->aredirect("");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MazadEgypt | Dashboard</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
    </head>

    <body>


        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h3 class="mb-3 text-center"><strong>Admin Login</strong></h3>
                    <div class="card">

                        <div class="card-body p-5">
                            <?php if ($session->has("adminLoginError")) { ?>
                                <?php foreach ($_SESSION['adminLoginError'] as $_SESSION['error']) { ?>
                                    <div style="margin-bottom: 15px;text-align: center;font-size: 24px;border: 2px red solid;color: red;;width:450px;margin-right:230px">* <?= $_SESSION['error'] ?></div>
                                <?php } ?>
                            <?php } ?>

                            <?php $session->remove("adminLoginError"); ?>
                            <?php $session->remove("error"); ?>
                            <form method="POST" action="handlers/login.php">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input placeholder="Email" type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input placeholder="************" type="password" name="password" class="form-control">
                                </div>
                                <div class="text-center mt-5">
                                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php } ?>