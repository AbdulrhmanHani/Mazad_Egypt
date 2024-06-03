<?php

use MazadEgypt\Classes\Models\Auction;
use MazadEgypt\Classes\Models\User;

require_once("../app.php");
$au = new Auction;

$us = new User;
if ($request->postHas("submit")) {
    if ($session->has("user")) {
        $n = $session->get("user");
        $us = new User;
        $user = $us->selectWhere("name = '$n'")[0];
        $userId = $user['id'];
        $deletePassword = $request->post("deletePassword");
        if (password_verify($deletePassword, $user['password'])  == true) {



            $auctionUserIds = $au->selectWhere("user_id=$userId");
            foreach ($auctionUserIds as $auctionUserId) {
                $au->delete($auctionUserId['id']);
            }

            $us->delete("$userId");

            $session->destroy();
            $request->redirect("");
        } else {
            $session->set("deleteError", 'كلمة المرور غير صحيحة');
            $request->redirect("profile.php#delete-account");
        }
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