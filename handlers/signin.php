<?php

use MazadEgypt\Classes\Models\User;

require_once("../app.php");


$us = new User;
$errors = [];

if ($request->postHas('submit')) {
    $username = $request->post('username');
    $user = $us->selectWhere("name = '$username'");

    if ($user == true) {
        $password = $request->post('password');
        if (password_verify($password, $user[0]['password']) == true) { //PASSWORD VERIFIER
            $session->set("user", $user[0]['name']);
            $session->set("loginSuccess", "Login Successfully");
            $request->redirect("");
        } else {
            $errors[] = "<span class='text-light'>كلمة سر خاطئة للمستخدم: " . $user[0]['name'] . "</span>";
            $request->redirect("signin.php");
        }
    } else {
        $errors[] = "المستخدم غير موجود";
        $request->redirect("signin.php");
    }
    $session->set("loginError", $errors);
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