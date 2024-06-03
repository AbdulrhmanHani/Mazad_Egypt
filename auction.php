<?php

use MazadEgypt\Classes\Models\Auction;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;

require_once("app.php");



$us = new User;
$pr = new Product;

$productId = $request->get("id");


$product = $pr->selectId($productId);

if ($product['active'] == "yes") {

    if ($session->has("user")) {
        $n = $session->get("user");
        $user = $us->selectWhere("name = '$n'")[0];
        if (strlen($user['visa_card']) !== 16) {
            $request->redirect("profile.php#visa");
        }
    } else {
        $request->redirect("");
    }
?>
    <?php
    // In Auction Table
    $au = new Auction;

    $auctions = $au->selectWhere("product_id = $productId");

    // $auctionUserId = $auctions['user_id'];

    ?>
    <!DOCTYPE html>
    <html lang="ar">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Font Awesome Library -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php URL; ?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
        <!-- Main Template CSS File -->
        <link rel="stylesheet" href="<?= URL; ?>assets/css/auction.css">
        <!-- Render All Elements Normally -->
        <link rel="stylesheet" href="<?= URL; ?>assets/css/normalize.css" />
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500&display=swap" rel="stylesheet">
        <title>مزاد <?= $product['name']; ?> | مزاد ايجيبت</title>
        <link rel="icon" type="image" href="<?= URL; ?>images/illustration-law-concept_53876-5911.jpg">
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                display: none;
            }
        </style>

    </head>

    <body class="bg-secondary">

        <!-- Start Mazad -->
        <section class="all-mazad">
            <div class="container">
                <div class="time">
                    <h6>Days</h6>
                    <span class="days"></span>
                    <h6>Hours</h6>
                    <span class="hours"></span>
                    <h6>Minutes</h6>
                    <span class="minutes"></span>
                    <h6>Seconds</h6>
                    <span class="seconds"></span>
                </div>
                <div class="parent-date">
                    <h4 class="text-info"><?= $product['name']; ?></h3>

                        <input class="time-end" style="display: none;" value="<?= $product['user_finish_at']; ?>">


                        <div class="add-sellary">
                            <?php if ($user['id'] !== $product['product_owner']) { ?>
                            <?php } ?>
                            <div class="input">
                                <?php if ($session->has("AuctionErrors")) { ?>
                                    <?php foreach ($session->get("AuctionErrors") as $error) { ?>
                                        <h4 style="text-align: center;color: red;" class="bg-secondary"><?= $error; ?></h4>
                                    <?php } ?>
                                    <?php $session->remove("AuctionErrors"); ?>
                                <?php } ?>
                                <?php if ($user['id'] !== $product['product_owner']) { ?>
                                    <form action="<?= URL; ?>handlers/auction-value.php" method="POST">
                                        <input type="hidden" name="productId" value="<?= $productId; ?>">
                                        <input type="number" placeholder="L.E" name="price">
                                        <button name="ValueSubmit" class="btn-add">إضافة سعر</button>
                                        <div class="auctionEnded">
                                        </div>
                                    </form>
                                    <form action="<?= URL; ?>handlers/auction-refresh.php" method="POST">
                                        <input type="hidden" name="productId" value="<?= $productId; ?>">
                                        <div class="auctionEnded"></div>
                                        <button name="Refresh" class="btn-add" title="تحديث الصفحة"><i class="fas fa-redo"></i></button>
                                    </form>
                                <?php } else { ?>
                                    <form action="<?= URL; ?>handlers/auction-refresh.php" method="POST">
                                        <input type="hidden" name="productId" value="<?= $productId; ?>">
                                        <div class="auctionEnded"></div>
                                        <h4 class="bg-secondary">أنت صاحب المزاد لا يمكنك المشاركة</h4>
                                        <button name="Refresh" class="btn-add" title="تحديث الصفحة"><i class="fas fa-redo"></i></button>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                </div>
                <div class="mazad">
                    <div class="content">
                        <?php foreach ($auctions as $auction) { ?>
                            <?php
                            $USERID = $auction['user_id'];
                            $ADDEDAT = $auction['added_at'];
                            $USER = $us->selectId($USERID);
                            $USERNAME =  $USER['name'];
                            ?>
                            <div class="user" style="margin-top: 1.5px;">
                                <h4><?= $USERNAME; ?></h4>
                                <h4 class="text-success"><img src="<?= URL; ?>assets/images/line-chart-icon-23.jpg" class="line-chart"><?= $auction['price'] . "L.E"; ?></h4>
                                <h4><?= $ADDEDAT; ?></h4>
                            </div>
                        <?php } ?>

                    </div>

                </div>
            </div>
        </section>
        <div class="END" id="END"></div>
        <a href="#END"></a>

        <!-- End Mazad -->
    </body>
    <script src="<?= URL; ?>assets/js/auction.js"></script>

    </html>
<?php } elseif ($product['active'] == "no") {
    $session->set("auctionEnded", "لقد تم إنهاء هذا المزاد");
    $request->redirect("#sections");
} else { ?>
    <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
    <html>

    <head>
        <title>403</title>
    </head>

    <body>
        <h1>Forbidden</h1>
        <p>You don't have premission to access this resource.</p>
        <p>Additionally, a 403 forbidden
            error was encountered while trying to use an ErrorDocument to handle the request.</p>
        <hr>
        <address>Apache/2.4.51 (Win64) OpenSSL/1.1.1l PHP/8.1.0 Server at 192.168.137.1 Port 80</address>
    </body>

    </html>
<?php
    $request->redirect("");
} ?>