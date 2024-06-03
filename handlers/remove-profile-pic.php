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

    $us->update("profile_pic", "NULL", $user['id']);
    unlink(URL . "userPics/" . $user['profile_pic']);
    $request->redirect("profile.php#picture");
} else { ?>
    <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>Forbidden</title>
</head><body>
<h1>Forbidden</h1>
<p>You don't have premission to access this resource.</p>
<p>Additionally, a 403 forbidden
error was encountered while trying to use an ErrorDocument to handle the request.</p>
<hr>
<address>Apache/2.4.51 (Win64) OpenSSL/1.1.1l PHP/8.1.0 Server at 192.168.137.1 Port 80</address>
</body></html>
<?php } ?>