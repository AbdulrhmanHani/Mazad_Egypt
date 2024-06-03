<?php
require_once("../app.php");

use MazadEgypt\Classes\Models\Contact;
use MazadEgypt\Classes\Models\User;

$co = new Contact;
$us = new User;

//Start User//
if ($session->has("user")) {
    $n = $session->get("user");
    $user = $us->selectWhere("name = '$n'")[0];
    $userName = $user['name'];
} else {

    $userName = "Anonymous";
}
//End User//

//Check Post//
if ($request->postHas("submit")) {
    $message = $request->post("message");
    // Start Message Validation
    if (empty($message)) {
        $errors[] = "لا تترك الرسالة فارغة";
    } elseif (strlen($message) < 15) {
        $errors[] = "الرسالة قصيرة جدا";
    } elseif (strlen($message) >= 256) {
        $errors[] = "عدد حروف الرسالة يجب أن تكون أقل من أو تساوي 255 حرف";
    } elseif (is_numeric($message)) {
        $errors[] = "يجب أن تحتوي الرسالة علي حروف";
    } else {
        $message = trim(htmlspecialchars($message));
    }
    // End Message Validation

    if (empty($errors)) {
        // Insert Into DB
        $co->insert("username, message", " '$userName', '$message' ");
        $session->set("messageSuccess", "تم إرسال الرسالة للمسئولين بنجاح");
        $request->redirect("contact.php");
    } else {
        $session->set("messageErrors", $errors);
        $request->redirect("contact.php");
    }
} else {
    $request->redirect("");
}
