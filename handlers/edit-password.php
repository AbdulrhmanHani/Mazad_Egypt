<?php

use MazadEgypt\Classes\Models\User;

require_once("../app.php");

$us = new User;

if ($request->postHas("submit")) {

    $errors = [];

    if ($session->has("user")) {
        $n = $session->get("user");
        $user = $us->selectWhere("name = '$n'")[0];
    }

    $password = $request->post("password");
    // Edit Password Validation
    if (password_verify($password, $user['password']) == true) {

        $newPassword = $request->post("newPassword");

        // New Password Validation
        if (empty($newPassword)) {
            $errors[] = "*كلمة المرور الجديدة مطلوبة";
        } elseif (strlen($newPassword) < 4) {
            $errors[] = "*كلمة المرور الجديدة ضعيفة";
        } elseif (is_numeric($newPassword)) {
            $errors[] = "*كلمة المرور الجديدة يجب أن تحتوي علي حروف و أرقام";
        } else {
            $newPassword = htmlspecialchars(password_hash($request->post("newPassword"), PASSWORD_BCRYPT));
        }

        // Confirm New Password Validation
        $confirmNewPassword = $request->post("confirmNewPassword");
        if (empty($confirmNewPassword)) {
            $errors[] = "*تأكيد كلمة المرور الجديدة مطلوب";
            // } elseif ($confirmNewPassword !== $newPassword) {
        } elseif (password_verify($confirmNewPassword, $newPassword) !== true) {
            $errors[] = "*تأكيد كلمة المرور الجديدة لا يطابق كلمة المرور الجديدة";
        } else {
            $confirmNewPassword = trim(htmlspecialchars(password_hash($request->post("confirmNewPassword"), PASSWORD_BCRYPT)));
        }
    } elseif (empty($password)) {
        $errors[] = "*كلمة المرور الحالية مطلوبة";
    } else {
        $errors[] = "*كلمة المرور الحالية غير صحيحة";
    }

    if (empty($errors)) {
        $us->update("password", "'$confirmNewPassword'", $user['id']);
        $session->set("updatePasswordSuccess", "لقد تم تغيير كلمة المرور بنجاح");
        $request->redirect("profile.php#password");
    } else {
        $session->set("updatePasswordError", $errors);
        $request->redirect("profile.php#password");
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