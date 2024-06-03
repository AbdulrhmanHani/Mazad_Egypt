<?php
require_once("../../app.php");

use MazadEgypt\Classes\Models\Admin;

$ad = new Admin;
if ($session->has("admin")) {
    $e = $session->get("admin");
    $admin = $ad->selectWhere("email = '$e'");
    $session->destroy();
    $_SESSION = [];
    $request->aredirect("");
}
$request->aredirect("");
