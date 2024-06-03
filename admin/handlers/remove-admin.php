<?php

use MazadEgypt\Classes\Models\Admin;

require_once("../../app.php");
$ad = new Admin;
if ($request->get("id")) {

    $id = $request->get("id");
    if ($id == "1") {
        $request->aredirect("admins.php");
    } else {
        $ad->delete($id);
        $request->aredirect("admins.php");
    }
} else {
    $request->redirect("");
    $session->destroy();
}