<?php

use MazadEgypt\Classes\Models\User;

require_once("../../app.php");
$us = new User;
if ($request->get("id")) {

    $id = $request->get("id");
    $us->delete($id);
    $request->aredirect("users.php");
} else {
    $request->redirect("");
}