<?php

use MazadEgypt\Classes\Models\Piding;
use MazadEgypt\Classes\Models\Product;

require_once("../../app.php");
if ($request->getHas("id")) {
    $pr = new Product;
    $productId = $request->get("id");


    $pr->delete($productId);

    $request->aredirect("products.php");
} else {
    $request->redirect("");
}
