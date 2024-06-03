<?php

use MazadEgypt\Classes\Models\Order;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\Auction;
use MazadEgypt\Classes\Models\Profit;

require_once("../../app.php");

$or = new Order;
$pr = new Product;
$au = new Auction;
$pf = new Profit;

if ($request->get("id")) {
    $productId = $request->get("id");
    $creatorName = $request->get("creator_name");
    $creatorEmail = $request->get("creator_email");
    $creatorPhone = $request->get("creator_phone");
    $creatorAddress = $request->get("creator_address");
    $winnerName = $request->get("winner_name");
    $winnerEmail = $request->get("winner_email");
    $winnerPhone = $request->get("winner_phone");
    $winnerAddress = $request->get("winner_address");
    $product = $request->get("product");
    $lastPrice = $request->get("last_price");

    $profit = $lastPrice * 5 / 100;

    // Insert into Order Table

    $or->insert("creator_name, creator_email, creator_phone, creator_address, winner_name, winner_email, winner_phone, winner_address, product, last_price", " '$creatorName','$creatorEmail','$creatorPhone','$creatorAddress','$winnerName','$winnerEmail','$winnerPhone','$winnerAddress','$product','$lastPrice'");
    $pf->insert("profit, auction_name", " '$profit','$product' ");


    $auctionProductIds = $au->selectWhere("product_id=$productId");

    foreach ($auctionProductIds as $auctionProductId) {
        $au->delete($auctionProductId['id']);
    }

    $pr->delete($productId);

    $request->aredirect("orders.php");
} else {
    $request->redirect("");
}
