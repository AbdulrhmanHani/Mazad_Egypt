<?php

use MazadEgypt\Classes\Models\Auction;
use MazadEgypt\Classes\Models\Cat;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;

require_once("app.php");

$c = new Cat;
$id = $request->get("catid");
$cat = $c->selectId($id);
$pr = new Product;
$products = $pr->selectWhere("cat_id = $id");
$au = new Auction;
if ($session->has("user")) {
    $n = $session->get("user");

    $us = new User;
    $user = $us->selectWhere("name = '$n'")[0];
}

if ($cat == true) {
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
        <link rel="stylesheet" href="<?= URL; ?>assets/css/auctionpages.css">
        <!-- Render All Elements Normally -->
        <link rel="stylesheet" href="<?= URL; ?>assets/css/normalize.css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500&display=swap" rel="stylesheet">
        <title>اللوحات النادرة | مزاد ايجيبت</title>
        <link rel="icon" type="image" href="<?= URL; ?>assets/images/illustration-law-concept_53876-5911.jpg">
    </head>

    <body>
        <!-- Start Navbar -->
        <nav>
            <div class="container">
                <a href="<?= URL; ?>"><img src="<?= URL; ?>assets/images/LOGO.png" alt="" class="logo"></a>
                <div class="choose-mode"><i class="fas fa-moon"></i></div>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Start Add Auction -->
        <div class="add-auction">
            <?php if ($session->has("user")) { ?>
                <?php if ($session->has("aucationSuccess")) { ?>
                    <div class="text-center bg-success text-light mb-3" style="font-size: x-large;">
                        <?= $session->get("aucationSuccess"); ?>
                    </div>
                    <?php $session->remove("aucationSuccess"); ?>
                <?php } ?>
                <?php if ($session->has("aucationErrors")) { ?>
                    <?php foreach ($session->get("aucationErrors") as $error) { ?>
                        <div class="mb-3 ml-5" style="margin-left: 500px;margin-top: 10px;text-align: center;font-size: 24px;border: 2px red solid;color: red;background-color: white;width:450px;margin-right:230px">
                            <?= $error ?>*
                        </div>
                        <?php $session->remove("aucationErrors"); ?>
                    <?php } ?>
                <?php } ?>
                <div class="container">
                    <div class="box">
                        <img src="<?= URL; ?>assets/images/material-icon-2155448_960_720.png" alt="">
                        <h4> إنشاء مزاد للوحات النادرة</h4>
                        <Span>1000L.E</Span>
                    </div>
                </div>
            <?php } else { ?>
                <div class="container">
                    <div class="message">
                        <h4>يلزم تسجيل الدخول اولا قبل المشاركة في المزادات <a href="<?= URL . "signin.php"; ?>">هنا</a></h4>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- End Add Auction -->
        <!-- Start Add Details Auction -->
        <div class="overlay-background"></div>
        <div class="add-details-auction">
            <!-- FORM إنشاء مزاد جديد -->
            <form action="<?= URL; ?>handlers/auction.php?catid=<?= $cat['id'] ?>" method="POST" enctype="multipart/form-data">
                <label for="file-ip-1">اضافة صورة القطعة</label>
                <input name="image" type="file" id="file-ip-1" accept="image/*">
                <div class="preview">
                    <img id="file-ip-1-preview">
                </div>
                <label for="">اسم القطعة</label>
                <input name="productName" type="text" class="name-product">

                <label for="">وصف القطعة</label>
                <textarea name="productDesc" cols="30" rows="4" class="desc-product" maxlength="50"></textarea>
                <span class="count">50</span>

                <label for="">تاريخ انتهاء المزاد</label>
                <input type="datetime-local" name="endAt" placeholder="End Auction At" title="End Auction At">

                <label for="">بداية سعر القطعة من :</label>
                <input type="text" name="productPrice" class="price-product" placeholder="LE">

                <input name="fullName" type="text" placeholder="الأسم بالكامل">
                <input name="address" type="text" placeholder="العنوان">
                <input name="phoneNumber" type="tel" placeholder="رقم الهاتف">
                <input name="visaCard" class="fas fa-check" type="text" placeholder="رقم الفيزا">
                <div class="images-visa">
                    <img src="<?= URL; ?>assets/images/1200px-Visa.svg.png" alt="">
                    <img src="<?= URL; ?>assets/images/download.png" alt="">
                    <img src="<?= URL; ?>assets/images/PP_Acceptance_Marks_for_LogoCenter_150x94.png" alt="">
                </div>
                <div class="buttons">
                    <input type="submit" name="submit" value="إدخال" id="submit-data-auction">
                    <a href="<?= URL; ?>">إلغاء</a>
                </div>
            </form>
        </div>
        <!-- End Add Details Auction -->

        <!-- Start Auctions -->
        <section>
            <div class="container">
                <div class="auctions text-center">
                    <?php foreach ($products as $product) { ?>
                        <?php
                        $productOwnerID = $product['product_owner'];
                        $ProductOwneR = $us->selectId($productOwnerID);
                        $productId = $product['id'];

                        ?>
                        <div class="auction">
                            <img src="<?= URL; ?>uploads/<?= $product['img']; ?>" alt="">
                            <h4><?= $product['name']; ?></h4>
                            <p><?= $product['desc']; ?></p>
                            <span class="read-more text-success">صاحب المزاد: <?= $ProductOwneR['name']; ?></span>
                            <h5>الحد الأدني لسعر بدأ المزاد : <span><?= $product['price']; ?> L.E</span></h5>
                            <?php if ($session->has("user")) { ?>
                                <?php if ($user['visa_card'] == 0) { ?>
                                    <h4 class="text-danger">برجاء ادخال الفيزا من <a href="<?= URL . "profile.php#visa-card"; ?>">هنا</a></h4>
                                <?php } else { ?>
                                    <?php if ($product['active'] == "yes") { ?>
                                        <a href="<?= URL . "auction.php?id=" . $product['id']; ?>"><button title="دخول مزاد <?= $product['name'] ?>" class="join-auction">دخول</button></a>
                                    <?php } elseif ($product['active'] == "no") { ?>
                                        <h4 class="text-danger">لقد تم إنتهاء هذا المزاد</h4>
                                    <?php } elseif ($product['active'] == "finished") { ?>
                                        <h4 class="text-success">تم الموافقة علي هذا المزاد</h4>
                                    <?php } else { ?>
                                        <h4 class="text-info">جاري تفعيل المزاد</h4>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="read-more-desc">
                            <button id="cancel-desc-auction">X</button>
                            <p><?= $product['desc']; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- End Auctions -->
       
        <!-- scroll Top -->
        <div class="scroll-btn">
            <i class="fa fa-angle-double-up"></i>
        </div>

        <!-- JavaScript -->
        <script src="<?= URL; ?>assets/js/addauction.js"></script>
    </body>

    </html>
<?php } else { ?>
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
<?php } ?>