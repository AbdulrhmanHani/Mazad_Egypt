<?php

use MazadEgypt\Classes\Models\User;
use MazadEgypt\Classes\Validation\Numeric;

require_once("../app.php");

$us = new User;

if ($request->postHas("submit")) {

    $errors = [];

    if ($session->has("user")) {
        $n = $session->get("user");
        $user = $us->selectWhere("name = '$n'")[0];
    }

    $creditCard = $request->post("creditCard");
    $creditCardDate = $request->post("creditCardDate");
    $creditCardPassword = $request->post("creditCardPassword");

    // Credit Card Validation
    // 1- Must == 16 Number
    if (empty($creditCard)) {
        $errors[] = "البطاقة الإئتمانية فارغة";
    } elseif (strlen($creditCard) !== 16) {
        $errors[] = "رقم البطاقة الإئتمانية غير صحيح, يجب أن يحتوي علي 16 رقم";
    } elseif (!is_numeric($creditCard)) {
        $errors[] = "البطاقة الإئتمانية يجب أن تكون رقم";
        // 2- Uniqe
    } elseif ($us->getCountCreditCard($creditCard) > 0) {
        $errors[] = "هذه البطاقة الإئتمانية موجودة بالفعل مع مستخدم اخر";
        // Credit Card Password Validation
    } elseif (strlen($creditCardPassword) !== 4) {
        $errors[] = "كلمة مرور البطاقة الإئتمانية يجب أن تحتوي علي 4 أرقام فقط";
    } elseif (!is_numeric($creditCardPassword)) {
        $errors[] = "كلمة مرور البطاقة الإئتمانية يجب أن تكون رقم";
    }


    if (empty($errors)) {
        $us->update("visa_card", "'$creditCard'", $user['id']);
        $session->set("visaSuccess", "تم إضافة البطاقة الإئتمانية بنجاح");
        $request->redirect("profile.php#visa-card");
    } else {
        $session->set("visaErrors", $errors);
        $request->redirect("profile.php#visa-card");
    }
} else { ?>
    <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
    <html>

    <head>
        <title>Forbidden</title>
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