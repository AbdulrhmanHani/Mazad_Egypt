<?php

use MazadEgypt\Classes\Models\Cat;

require_once("../../app.php");
$c = new Cat;

if ($request->getHas("id")) {
    $id = $request->get("id");

    $thisCat = $c->selectId($id);

    $request->aredirect("");

    
    
} else {
    $request->aredirect("");
}
