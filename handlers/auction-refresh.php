<?php
require_once('../app.php');

use MazadEgypt\Classes\Models\Product;

$pr = new Product;

if ($request->postHas("Refresh")) {
    $productId = $request->post("productId");
    if ($request->postHas("auctionEnded")) {
        $pr->update("active", " 'no' ", $productId);
        $session->set("auctionEnded", "لقد تم إنهاء هذا المزاد");
        $request->redirect("#sections");
    } else {
        $request->redirect("auction.php?id=$productId");
    }
} else {
    $request->redirect("");
}
