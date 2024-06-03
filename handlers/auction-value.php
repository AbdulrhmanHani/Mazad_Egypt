<?php
require_once("../app.php");
// Product Id | User Price For This Product | User \\

// So We Need In Pidding Table in DB
// 1- user_id
// 2- user_price
// 3- product_id
// 4- started_at
// 5- finish_at

// id : int(10) unsigned
// * price : int(11)
// * user_id : int(10) unsigned
// * product_id : int(10) unsigned
// * added_at : datetime
// * finish_at : datetime

use MazadEgypt\Classes\Models\Auction;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;

$pr = new Product;
$au = new Auction;
// User
$us = new User;
if ($session->has("user")) {
    $n = $session->get("user");
    $user = $us->selectWhere("name = '$n'")[0];
    $userId = $user['id'];
} else {
    $request->redirect("");
}
// Price
if ($request->postHas("ValueSubmit")) {

    $productHeighstPrice = $request->post("price");

    $productId = $request->post("productId");

    // Product
    $product = $pr->selectId($productId);

    $productPrice = $product['price'];

    // Auction
    $auction = $au->selectWhere("product_id = $productId");

    $auctionLast = end($auction);
} else {
    $request->redirect("");
}


# Validation #

//numeric
if (empty($productHeighstPrice)) {
    $errors[] = "يجب أن تضع مبلغ";
} elseif (!is_numeric($productHeighstPrice)) {
    $errors[] = "المبلغ يجب أن يكون رقم";
} elseif ($productHeighstPrice <= $auctionLast['price']) {
    $errors[] = "أضف مبلغ أكبر";
} elseif ($productHeighstPrice <= $product['price']) {
    $errors[] = "أدخل رقم أكبر من  $productPrice";
}
if ($request->postHas("auctionEnded")) {
    $pr->update("active", " 'no' ", $productId);
    $session->set("auctionEnded", "لقد تم إنهاء هذا المزاد");
    $request->redirect("#sections");
} elseif (empty($errors)) {

    $au->insert("price, user_id, product_id", " '$productHeighstPrice', '$userId', '$productId' ");
    $request->redirect("auction.php?id=" . $productId . "#END");
} else {
    $session->set("AuctionErrors", $errors);
    $request->redirect("auction.php?id=" . $productId . "#END");
}
