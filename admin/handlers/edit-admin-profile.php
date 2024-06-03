<?php
require_once('../../app.php');

use MazadEgypt\Classes\Models\Admin;

if ($session->has("admin")) {
    if ($session->has("admin")) {
        $n = $session->get("admin");
        $ad = new Admin;
        $admin = $ad->selectWhere("name = '$n'")[0];
    }

    $errors = [];

    if ($request->postHas("submit")) {

        // UserName Validation
        $username = $request->post("username");
        if (empty($username)) {
            $username = $admin['name'];
        } else {
            if ($ad->getCountUser($username) > 0) {
                $errors[] = "This Username Is Aleady Exist";
            } elseif (!is_string($username) || is_numeric($username)) {
                $errors[] = "Username Must Be String";
            } elseif (strlen($username) < 8) {
                $errors[] = "Username Must Be Greater Than 8 Chars";
            } elseif (strlen($username) > 255) {
                $errors[] = "Username Must Be Less Than 255 Chars";
            } else {
                $username = trim(htmlspecialchars($request->post("username")));
            }
        }

        // Email Validation
        $email = $request->post('email');
        if (empty($email)) {
            $email = $admin['email'];
        } else {
            if ($ad->getCountEmail($email) > 0) {
                $errors[] = "This Email Is Aleady Exist";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Enter A Valid Email";
            } elseif (strlen($email) > 255) {
                $errors[] = "Email Length Must Be Less Than 255 Character";
            } else {
                $email = trim(htmlspecialchars($request->post("email")));
            }
        }

        // Password Validation
        $password = $request->post("password");
        if (empty($password)) {
            $password = $admin['password'];
        } else {
            if (strlen($password) < 8) {
                $errors[] = "Password Is Weak";
            } elseif (is_numeric($password)) {
                $errors[] = "Password Must Contain Chars";
            } else {
                $password = trim(htmlspecialchars(password_hash($request->post("password"), PASSWORD_BCRYPT)));
            }
        }

        // Confirmation Update
        if (empty($errors)) {
            $ad->update("name", " '$username' ", $admin['id']);
            $session->set("admin", $username);
            $ad->update("email", " '$email' ", $admin['id']);
            $ad->update("password", " '$password' ", $admin['id']);
            $session->set("editAdminSuccess", "Profile Updated Successfully");
            $request->aredirect("profile.php");
        } else {
            $session->set("editAdminErrors", $errors);
            $request->aredirect("profile.php");
        }
    } else {
        $request->redirect("");
    }
}
