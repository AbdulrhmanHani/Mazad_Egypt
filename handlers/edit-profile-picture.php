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


    $image = $_FILES["image"];
    // Image & Image Validation
    $imageName = $image['name'];
    $imageType = $image['type'];
    $imageTempName = $image['tmp_name'];
    $imageError = $image['error'];
    $imageSize = $image['size'];
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    // Validatoin
    // 1- error = 0
    // 2- ext(png, jpg, jpeg)
    // 3- size <= 1MB
    $imageSizeMb = $imageSize / (1024 ** 2);
    if ($imageError != 0) {
        $errors[] = "*يجب أن تختار صورة أولا";
    } elseif (!in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])) {
        $errors[] = "*( jpg, png or jpeg ) إمتداد الصورة يجب أن يكون واحد من";
    } elseif ($imageSizeMb >= 3) {
        $errors[] = "*أقصي حجم للصورة 4 ميجا";
    }
    if (empty($errors)) {
        // If Valid --> Rename Image Name
        $randomStr = uniqid();
        $imageNewName = "$randomStr.$ext";
        //--> Move To Distination
        move_uploaded_file($imageTempName, PATH . "userPics/$imageNewName");
        $us->update("profile_pic", "'$imageNewName'", $user['id']);
        $session->set("editProfileSuccess", "*لقد تم تغيير الصورة الشخصية بنجاح*");
    } else {
        $session->set("editProfileError", $errors);
    }
    $request->redirect("profile.php#picture");
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
<?php $request->redirect("profile.php");
}; ?>