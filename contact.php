<?php

use MazadEgypt\Classes\Models\User;

require_once("app.php");

if ($session->has("user")) {
    $n = $session->get("user");
    $us = new User;
    $user = $us->selectWhere("name = '$n'")[0];
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Main files CSS -->
    <link rel="stylesheet" href="<?= URL; ?>assets/css/contact.css">
    <title> تواصل معنا | مزاد ايجيبت</title>
</head>

<body>
    <nav><a href="<?= URL; ?>index.php"><img src="<?= URL; ?>assets/images/LOGO.png" alt=""></a></nav>
    <div>
        <?php if ($session->has("user")) { ?>
            <h3>Username: <?= $user['name']; ?></h3>
        <?php } else { ?>
            <h3>Anonymous Message</h3>
        <?php } ?>
        <form action="<?= URL; ?>handlers/send-message.php" method="POST">
            <textarea name="message" id="" cols="30" rows="4" maxlength="255" placeholder="اكتب الرسالة..."></textarea>
            <span class="progress"></span>
            <span class="count">250</span>
            <input type="submit" name="submit" value="إرسال">
        </form>
        <?php if ($session->has("messageSuccess")) { ?>
            <div class="parent-errors"  style="width: auto;">
                <div style="font-size: x-large;color: green;"><?= $session->get("messageSuccess"); ?></div>
                <div class="cancel-errors">
                    <a href="<?= URL; ?>contact.php"><button>X</button></a>
                    <?php $session->remove("messageSuccess"); ?>
                </div>
            </div>

        <?php } elseif ($session->has("messageErrors")) { ?>

            <div class="parent-errors" style="width: auto;">
                <?php foreach ($session->get("messageErrors") as $error) { ?>
                    <div style="font-size: x-large;color: red;"><?= $error; ?></div>
                    <div class="cancel-errors">
                        <a href="<?= URL; ?>contact.php"><button>X</button></a>
                        <?php $session->remove("messageErrors"); ?>
                    </div>
            </div>
        <?php } ?>
    <?php } ?>
    </div>
    <script src="<?= URL; ?>assets/js/contact.js"></script>
</body>

</html>