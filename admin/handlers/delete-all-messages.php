<?php
require_once("../../app.php");

use MazadEgypt\Classes\Models\Contact;


$co = new Contact;


$allMessages = $co->selectAll();

foreach ($allMessages as $message) {

    $messageId = $message['id'];
    $co->delete($messageId);
    $request->aredirect("messages.php");
}
$request->aredirect("messages.php");
