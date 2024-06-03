<?php

use MazadEgypt\Classes\Models\User;

require_once("app.php");

if ($session->has("user")) {
    $n = $session->get("user");
    $us = new User;
    $user = $us->selectWhere("name = '$n'")[0];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= URL; ?>assets/css/bootstrap.min.css">
        <title>Mazad Egypt | Profile</title>
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                display: none;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h3 class="mb-3 text-center text-secondary"><strong class="text-primary">( <?= $user['name']; ?> ) :الصفحة الشخصية</strong></h3>
                    <div class="card">
                        <div class="card-body p-5">


                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <a class="ml-4 btn btn-dark px-5 mb-5 py-2 px-2" href="<?= URL; ?>">رجوع</a>
                                </div>
                                <hr width="460px" style="height: 1.4px; background-color: black;">
                            </div>
                            <!-- Change Profile Picture -->
                            <a href="#picture"></a>
                            <section class="picture" id="picture">
                                <?php if ($session->has("editProfileError")) { ?>
                                    <?php foreach ($_SESSION['editProfileError'] as $error) { ?>
                                        <div class="text-danger"><?= $error; ?></div>
                                        <?php $session->remove("editProfileError"); ?>
                                    <?php } ?>
                                <?php } ?>

                                <?php if ($session->has("editProfileSuccess")) { ?>
                                    <div class="text-success">
                                        <h5><?= $session->get("editProfileSuccess"); ?></h5>
                                    </div>
                                    <?php $session->remove("editProfileSuccess"); ?>
                                <?php } ?>

                                <form method="POST" action="handlers/edit-profile-picture.php" enctype="multipart/form-data">
                                    <div class="form-group text-center">
                                        <h4 style="color: green;">تغيير الصورة الشخصية</h4>
                                        <?php if ($user["profile_pic"] == "NULL" || $user["profile_pic"] == "") { ?>
                                            <img width="200px" src="<?= URL . "userPics/default.jpg"; ?>" alt="">
                                        <?php } else { ?>
                                            <img width="200px" src="<?= URL . "userPics/" . $user['profile_pic']; ?>" alt="">
                                        <?php } ?>
                                        <input type="file" name="image" value="file" class="mt-3 form-control btn">
                                        <button require type="submit" name="submit" value="submit" class="mt-3 ml-5 btn px-4 btn-success mr-5">تغيير الصورة الشخصية</button>
                                    </div>
                                </form>
                                <!-- Remove Profile Picture -->
                                <form method="POST" action="<?= URL . "handlers/remove-profile-pic.php"; ?>">
                                    <div class="form-group text-center">
                                        <button require type="submit" name="submit" value="submit" class="mt-3 ml-5 btn px-4 btn-warning mr-5">إزالة الصورة الشخصية</button>
                                    </div>
                                </form>
                                <hr width="330px" style="height: 1.4px; background-color: green;">

                                <?php if ($session->has("visaErrors")) { ?>
                                    <?php foreach ($_SESSION['visaErrors'] as $visaError) { ?>
                                        <div class="text-danger my-2"><?= "*" .  $visaError; ?></div>
                                        <?php $session->remove("visaErrors"); ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($session->has("visaSuccess")) { ?>
                                    <div class="text-success">
                                        <h5><?= "*" . $session->get("visaSuccess"); ?></h5>
                                    </div>
                                    <?php $session->remove("visaSuccess"); ?>
                                <?php } ?>
                                <!-- Visa Card -->
                                <a href="#visa-card"></a>
                                <section class="visa-card" id="visa-card">
                                    <form method="POST" action="handlers/add-card.php" enctype="multipart/form-data">
                                        <div class="form-group text-center">
                                            <h4 class="text-dark">إضافة بطاقة إئتمانية</h4>
                                            <input require placeholder="رقم البطاقة الإئتمانية" type="number" name="creditCard" class="form-control">
                                            <p class="text-dark">لا بد أن تحتوي علي 16 رقم</p>
                                            <input require placeholder="تاريخ إنتهاء الفعالية" name="creditCardExDate" type="date" class="form-control mt-2">
                                            <p class="text-dark">تاريخ إنتهاء فعالية البطاقة</p>
                                            <input require placeholder="كلمة مرور البطاقة الإئتمانية" name="creditCardPassword" type="password" class="form-control mt-2">
                                            <p class="text-dark">كلمة مرور البطاقة تحتوي علي 4 أرقام</p>
                                            <button require type="submit" name="submit" value="submit" class="mt-3 ml-5 btn px-4 btn-secondary mr-5">أضف</button>
                                        </div>
                                    </form>

                                    <hr width="330px" style="height: 1.4px; background-color: grey;">


                                    <!-- Update Password -->
                                    <a href="#password"></a>
                                    <section class="password" id="password">
                                        <section class="password" id="password">
                                            <?php if ($session->has("updatePasswordSuccess")) { ?>
                                                <div class="text-success my-2"><?= $session->get("updatePasswordSuccess"); ?></div>
                                                <?php $session->remove("updatePasswordSuccess"); ?>
                                            <?php } ?>
                                            <?php if ($session->has("updatePasswordError")) { ?>
                                                <?php foreach ($_SESSION['updatePasswordError'] as $error) { ?>
                                                    <div class="text-danger my-2"><?= $error; ?></div>
                                                    <?php $session->remove("updatePasswordError"); ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <form method="POST" action="<?= URL; ?>handlers/edit-password.php">
                                                <h4 style="text-align: center;" class="text-info">تغيير كلمة المرور</h4>
                                                <div class="form-group">
                                                    <label class="text-info">كلمة المرور الحالية</label>
                                                    <input require placeholder="****************" type="password" name="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-info">كلمة المرور الجديدة</label>
                                                    <input require placeholder="****************" type="password" name="newPassword" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-info">تأكيد كلمة المرور الجديدة</label>
                                                    <input require placeholder="****************" type="password" name="confirmNewPassword" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                </div>
                                                <div class="text-center mt-5">
                                                    <button require type="submit" name="submit" value="submit" class="ml-5 btn px-4 btn-primary mr-5">تغيير كلمة المرور</button>
                                                </div>
                                            </form>
                                            <hr width="330px" style="height: 1.4px; background-color: red;">
                                            <?php if ($session->has("deleteError")) { ?>
                                                <div style="color:red;background-color:white;padding: 15px;"><?= $session->get("deleteError") ?> *</div>
                                                <?php $session->remove("deleteError"); ?>
                                            <?php } ?>
                                            <!-- Delete Account -->
                                            <a href="#delete-account"></a>
                                            <section class="delete-account" id="delete-account">
                                                <form action="handlers/delete-account.php" method="POST">
                                                    <div class="text-center form-group">
                                                        <h1 class="text-center text-danger">حذف الحساب</h1>
                                                        <label>أدخل كلمة المرور لحذف حسابك</label>
                                                        <input require placeholder="****************" type="password" name="deletePassword" class="form-control">
                                                        <button require type="submit" name="submit" value="" class="btn btn-danger my-4">حذف الحساب</button>
                                                    </div>
                                                </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>

    </html>
<?php

} else {
    $request->redirect("");
}
?>