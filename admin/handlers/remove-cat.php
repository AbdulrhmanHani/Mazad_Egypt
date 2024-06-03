<?php

use MazadEgypt\Classes\Models\Cat;

require_once("../../app.php");
$c = new Cat;
if ($request->get("id")) {

    $id = $request->get("id");
    $c->delete($id);
    $request->aredirect("categories.php");
} else {
    $request->redirect("");
}