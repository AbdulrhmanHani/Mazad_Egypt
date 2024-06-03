<?php
require_once("../app.php");

use MazadEgypt\Classes\Models\User;

$us = new User;


if ($request->postHas("submit")) {
    $errors = [];
    // Username Validation
    $username = $request->post("username");
    if (empty($username)) {
        $errors[] = "اسم المستخدم مطلوب";
    } elseif ($us->getCountUser($username) > 0) {
        $errors[] = "هذا الاسم موجود بالفعل";
    } elseif (!is_string($username) || is_numeric($username)) {
        $errors[] = "اسم المستخدم لابد أن يحتوي علي حروف";
    } elseif (strlen($username) > 255) {
        $errors[] = "اسم المستخدم كبير";
    } elseif (strlen($username) <= 3) {
        $errors[] = "اسم المستخدم صغير";
    } else {
        $username = trim(htmlspecialchars($request->post("username")));
    }

    // address
    $address = $request->post("address");
    if (empty($address)) {
        $errors[] = "العنوان مطلوب";
    } elseif (is_numeric($address)) {
        $errors[] = "أدخل عنوان صحيح";
    } else {
        $address = trim(htmlspecialchars($request->post("address")));
    }

    // phone
    $phone = $request->post("phone");
    if (empty($phone)) {
        $errors[] = "رقم الهاتف مطلوب";
    } elseif (!is_numeric($phone)) {
        $errors[] = "رقم الهاتف غير صحيح";
    } else {
        $phone = trim(htmlspecialchars($request->post("phone")));
    }


    //email Validation
    $email = $request->post('email');
    if (empty($email)) {
        $errors[] = "البريد الإلكتروني مطلوب";
    } elseif ($us->getCountEmail($email) > 0) {
        $errors[] = "هذا البريد موجود بالفعل";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "البريد الإلكتروني غير صحيح";
    } elseif (strlen($email) > 255) {
        $errors[] = "البريد الالكتروني كبير للغاية";
    } else {
        $email = trim(htmlspecialchars($request->post("email")));
    }



    //Password Validation
    $password = $request->post('password');
    if (empty($password)) {
        $errors[] = "كلمة المرور مطلوبة";
    } elseif (strlen($password) < 8) {
        $errors[] = "كلمة المرور ضعيفة";
    } elseif (is_numeric($password)) {
        $errors[] = "كلمة المرور لابد ان تحتوي علي حروف و أرقام";
    } else {
        $password = trim(htmlspecialchars(password_hash($request->post("password"), PASSWORD_BCRYPT)));
    }


    if (empty($errors)) {
        $us->insert("name, email, password, visa_card, address, phone", " '$username', '$email', '$password', '0', '$address', '$phone' ");
        $session->set("registerSuccess", "تم إنشاء الحساب بنجاح");
        $request->redirect("signin.php");
    } else {
        $session->set("registerErrors", $errors);
        $request->redirect("register.php");
    }



    // $us = new User;
    // $user = $us->insert("name, email, password", "");
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