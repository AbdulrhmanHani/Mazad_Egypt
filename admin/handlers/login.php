<?php

use MazadEgypt\Classes\Models\Admin;

require_once("../../app.php");
$ad = new Admin;

if ($request->postHas("submit")) {
    $email = $request->post("email");
    $admin = $ad->selectWhere("email = '$email'");

    if ($admin == true) {
        $password = $request->post("password");
        if (password_verify($password, $admin[0]['password']) == true) {
            $session->set("admin", $admin[0]['name']);
            $request->aredirect("");
        } else {
            $errors[] = "<span class='text-danger'>Incorrect Password For: " . $admin[0]['email'] . "</span>";
            $request->aredirect("login.php");
        }
    } else {
        $errors[] = "Email Doesn't exist";
        $request->aredirect("login.php");
    }
    $session->set("adminLoginError", $errors);
} else {
    echo "False";
}
