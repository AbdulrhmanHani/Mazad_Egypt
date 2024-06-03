<?php

use MazadEgypt\Classes\Models\Admin;

require_once("../../app.php");

$ad = new Admin;
if ($request->postHas("submit")) {
    $errors = [];
    // name Validation
    $name = $request->post("name");
    if (empty($name)) {
        $errors[] = "Name Is Required";
    } elseif ($ad->getCountUser($name) > 0) {
        $errors[] = "This name Is Aleady Exist";
    } elseif (!is_string($name) || is_numeric($name)) {
        $errors[] = "name Must Be String";
    } elseif (strlen($name) > 255) {
        $errors[] = "name Must Be Less Than 255 Chars";
    } else {
        $name = trim(htmlspecialchars($request->post("name")));
    }



    //email Validation
    $email = $request->post('email');
    if (empty($email)) {
        $errors[] = "Email Is Required";
    } elseif ($ad->getCountEmail($email) > 0) {
        $errors[] = "This Email Is Aleady Exist";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter A Valid Email";
    } elseif (strlen($email) > 255) {
        $errors[] = "Email Length Must Be Less Than 255 Character";
    } else {
        $email = trim(htmlspecialchars($request->post("email")));
    }



    //Password Validation
    $password = $request->post('password');
    if (empty($password)) {
        $errors[] = "Password Is Required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password Is Weak";
    } elseif (is_numeric($password)) {
        $errors[] = "Password Must Contain Chars";
    } else {
        $password = trim(htmlspecialchars(password_hash($request->post("password"), PASSWORD_BCRYPT)));
    }

    // Is Super VAlidation
    $is_super = $request->post("super");
    if ($is_super === "yes") {
        $is_super = "yes";
    } else {
        $is_super = "no";
    }

    if (empty($errors)) {
        $ad->insert("name, email, password, is_super", " '$name', '$email', '$password', '$is_super'");
        $session->set("newAdminSuccess", "Admin Added Successfully");
        $request->aredirect("admins.php");
    } else {
        $session->set("newAdminErrors", $errors);
        $request->aredirect("add-admin.php");
    }
} else {
    $request->redirect("");
}
