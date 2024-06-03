<?php require_once("app.php");

if ($session->has("user")) {
    $request->redirect("");
} else {
?>
    <!DOCTYPE html>
    <html lang="ar">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Render All Elements Normally -->
        <link rel="stylesheet" href="<?= URL; ?>assets/css/normalize.css">
        <!-- Font Awesome Library -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php URL; ?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
        <!-- Main Template CSS File -->
        <link rel="stylesheet" href="<?= URL; ?>assets/css/style.css">
        <link rel="stylesheet" href="<?= URL; ?>assets/css/form.css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500&display=swap" rel="stylesheet">
        <title>تسجيل الدخول | مزاد ايجيبت</title>
        <link rel="icon" type="image" href="<?= URL; ?>assets/images/illustration-law-concept_53876-5911.jpg">
    </head>

    <body>
        <!-- Start Navbar -->
        <nav>
            <div class="container">
                <a href="<?= URL; ?>"><img src="<?= URL; ?>assets/images/LOGO 2.png" alt=""></a>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Start Form -->
        <div class="form">
            <img src="<?= URL; ?>assets/images/100_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" alt="">

            <?php if ($session->has("registerSuccess")) { ?>
                <div class="parent-errors">
                    <div style="margin-top: 10px;text-align: center;font-size: 24px;color: green;width:auto;"><?= $_SESSION['registerSuccess']; ?></div>
                    <div class="cancel-errors">
                        <a href=""><button><a href="<?= URL . "signin.php" ?>">X</a></button></a>
                    </div>
                </div>
                <?php $session->remove("registerSuccess"); ?>
            <?php } elseif ($session->has('loginError')) { ?>
                <strong>
                    <div class="parent-errors">
                        <div style="margin-top: 10px;text-align: center;font-size: 24px;color: red;width:auto;">* <?= $_SESSION['loginError'][0]; ?></div>
                        <div class="cancel-errors">
                            <a href=""><button><a href="<?= URL . "signin.php" ?>">X</a></button></a>
                        </div>
                    </div>
                </strong>
                <?php $session->remove("loginError"); ?>
            <?php } ?>
            <form action="handlers/signin.php" method="POST">
                <div class="input">
                    <i class="fas fa-user user"></i>
                    <input type="text" name="username" value="" placeholder="اسم المستخدم" class="username">
                </div>
                <div class="input">
                    <i class="fas fa-lock lock"></i>
                    <input type="password" name="password" value="" placeholder="كلمة المرور" class="password">
                </div>
                <input type="submit" value="تسجيل الدخول" name="submit" class="submit">
                <span><a href="<?= URL; ?>register.php">إنشاء حساب</a></span>
            </form>
        </div>

        <!-- JavaScript -->
        <script src="<?= URL; ?>assets/js/app.js"></script>
    </body>
    </html>
<?php } ?>