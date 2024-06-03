<?php

require_once("app.php");

use MazadEgypt\Classes\Models\Cat;
use MazadEgypt\Classes\Models\User;
use MazadEgypt\Classes\Models\Order;

$c = new Cat;
$cats = $c->selectAll();
$or = new Order;
$orders = $or->selectAll();
?>

<!DOCTYPE html>
<html lang="ar">
<?php
if ($session->has("user")) {
    $n = $session->get("user");
    $us = new User;
    $user = $us->selectWhere("name = '$n'")[0];
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="<?= URL; ?>assets/css/normalize.css" />
    <!-- Font Awesome Library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php URL; ?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="<?= URL; ?>assets/css/style.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500&display=swap" rel="stylesheet">
    <title> الصفحة الرئيسية | مزاد ايجيبت</title>
    <link rel="icon" type="image" href="<?= URL; ?>assets/images/illustration-law-concept_53876-5911.jpg">
</head>

<body>
    <!-- Start Header -->


            
    <header id="home">
        <video src="<?= URL; ?>assets/images/video.mp4" muted autoplay loop></video>
        <nav>
            <div class="container">
                <img src="<?= URL; ?>assets/images/LOGO 2.png" alt="">
                <ul>
                    <?php if ($session->has("user")) { ?>
                        <!-- Start Loading -->
                        <div class="loading"><img src="<?= URL; ?>assets/images/sound.gif" alt="" class="load"></div>
                        <!-- End Loading -->
                        <li><a href="<?= URL . "handlers/logout.php"; ?>" id="logout">تسجيل الخروج</a></li>
                    <?php } elseif ($session->has("user") == 0) { ?>
                        <li><a href="<?= URL; ?>signin.php" id="login">تسجيل الدخول</a></li>
                        <li><a href="<?= URL; ?>register.php" id="register">إنشاء حساب</a></li>
                    <?php } ?>
                    <li><a href="<?= URL; ?>questions.php">الأسئلة الشائعة</a></li>
                    <?php if ($session->has("user")) { ?>
                        <a href="<?= URL . "profile.php"; ?>">
                            <li class="user"><span class="text-info"><?= $user['name']; ?></span></li>
                        </a>
                        <a href="<?= URL . "profile.php"; ?>">
                            <?php if ($user["profile_pic"] == "") { ?>
                                <li id="img-user"><img src="<?= URL; ?>userPics/default.jpg" alt="Edit Profile"></li>
                            <?php } else { ?>
                                <li id="img-user"><img src="<?= URL; ?>userPics/<?= $user['profile_pic']; ?>" alt="here"></li>
                            <?php } ?>
                        </a>
                    <?php } ?>
                    <li><i class="fas fa-bars bars"></i></li>
                </ul>
            </div>
            <div class="toggle-menu">
                <?php if ($session->has("user")) { ?>
                    <a href="<?= URL; ?>handlers/logout.php" class="log-out">تسجيل الخروج</a>
                    <ul>
                    <?php } else { ?>
                        <li id="login-toggle-menu"><a href="<?= URL; ?>signin.php">تسجيل الدخول</a></li>
                        <li id="register-toggle-menu"><a href="<?= URL; ?>register.php">إنشاء حساب</a></li>
                    <?php } ?>
                    <li><a href="<?= URL; ?>questions.php">الأسئلة الشائعة</a></li>
                    </ul>
            </div>
        </nav>
        <div class="landing">
            <div class="container">
                <div class="content">
                    <h2>مرحبا بك في موقع مزاد ايجيبت</h2>

                <!-- START If $session->user Is The Winner Print Message To him -->
                <?php
            if ($session->has("user")) {
                foreach ($orders as $order) {
                    if ($user['name'] == $order['winner_name']) {
                        $orderProduct = $order['product'];
                        $session->set("winnerMessage", ":لقد ربحت في المزاد ($orderProduct" . ") " . "برجاء إنتظار مكالمة من المسؤولين عن الموقع");
                    }
                }
            }
            ?>
            <?php if ($session->has("winnerMessage")) { ?>
                <div class="parent-errors" style="position: absolute;top: 50vh;">
                    <div style="color: green;">
                        <?= $session->get("winnerMessage"); ?>
                    </div>
                    <div class="cancel-errors">
                        <a href="<?= URL . "handlers/remove-message.php"; ?>"><button>X</button></a>
                    </div>
                </div>
            <?php } ?>
            
            <!-- END If $session->user Is The Winner Print Message To him -->
                    
                </div>
            </div>
        </div>
        <a href="#sections"><i class="fas fa-angle-double-down go-down"></i></a>
    </header>
    <!-- End Header -->
    <!-- Start Sections -->
    <section class="sections" id="sections">
        <div class="container">
            <?php if ($session->has("aucationSuccess")) { ?>
                <div class="parent-errors">
                    <div style="font-size: x-large;color: green;"><?= $session->get("aucationSuccess"); ?></div>
                    <div class="cancel-errors">
                        <a href="#sections"><button><a href="<?= URL; ?>">X</a></button></a>
                    </div>
                </div>
                <?php $session->remove("aucationSuccess"); ?>
            <?php } ?>
            <?php if ($session->has("aucationErrors")) { ?>
                <div class="parent-errors">
                    <?php foreach ($session->get("aucationErrors") as $error) { ?>
                        <div style="color: red;">
                            <?= $error ?>*
                        </div>
                        <?php $session->remove("aucationErrors"); ?>
                    <?php } ?>
                    <div class="cancel-errors">
                        <a href="#sections"><button><a href="<?= URL; ?>">X</a></button></a>
                    </div>
                </div>
            <?php } ?>
            <?php if ($session->has("auctionEnded")) { ?>
                <div class="parent-errors">
                    <div style="color: orange;">
                        <?= $session->get("auctionEnded"); ?>*
                    </div>
                    <div class="cancel-errors">
                        <a href="#sections"><button><a href="<?= URL; ?>">X</a></button></a>
                    </div>
                </div>
            <?php } ?>
            <?php $session->remove("auctionEnded"); ?>

            <h2 class="special-heading">الأقسام</h2>
            <div class="boxes">
                <?php foreach ($cats as $cat) { ?>
                    <div class="box">
                        <a href="<?= URL . $cat['name']; ?>.php?catid=<?= $cat['id']; ?>">
                            <img src="<?= URL; ?>assets/images/<?= $cat['img']; ?>" alt="">
                        </a>
                        <h4><?= $cat['arabic_name'] ?></h4>
                        <a href="<?= URL . $cat['name']; ?>.php?catid=<?= $cat['id']; ?>"><button>عرض</button></a>
                    </div>
                <?php } ?>
            </div>
    </section>
    <!-- End Sections -->
    <!-- scroll Top -->
    <div class="scroll-btn">
        <i class="fa fa-angle-double-up"></i>
    </div>
    <div class="message-me">
        <a href="<?= URL; ?>contact.php" title="تواصل معنا"><i class="fa fa-comment-alt"></i></a>
    </div>
    <!-- Start Footer -->
    <footer>
        <h4>© 2022 مزاد ايجيبت. جميع الحقوق محفوظة. </h4>
    </footer>
    <!-- End Footer -->

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= URL; ?>assets/js/app.js"></script>
</body>

</html>