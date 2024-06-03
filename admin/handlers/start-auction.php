<?php

use MazadEgypt\Classes\Models\Product;

require_once("../../app.php");

$pr = new Product;

if ($request->getHas("id")) {
    $id = $request->get("id");
    $product = $pr->selectId($id);
    $productName = $product['name'];

    $pr->update("active", " 'yes' ", $id);
    $session->set("auctionActivated", "Auction $productName Is Activated");
    $request->aredirect("products.php");
} else {
    $request->redirect("");
}
