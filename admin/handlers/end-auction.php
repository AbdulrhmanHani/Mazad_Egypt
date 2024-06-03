<?php

use MazadEgypt\Classes\Models\Auction;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;

require_once("../../app.php");

$pr = new Product;
$au = new Auction;
$us = new User;
if ($request->getHas("id")) {
    $productId = $request->get("id");
    // last input in Auction
    $auction = $au->selectWhere("product_id = $productId");
    if (end($auction) == null) {
        foreach ($auction as $AUCTIN) {
            $au->delete($productId['id']);
        }
        $pr->delete("$productId");
        $request->aredirect("ended-auction.php");
    } else {
        $auction = end($au->selectWhere("product_id = $productId"));
    }
    //winner in This Auction
    $winnerUserID = $auction['user_id'];
    $winnerUser = $us->selectId($winnerUserID); //# User
    $finish_at = date("Y-m-d H:i");
    $au->update("finish_at", " '$finish_at' ", $auction['id']);
    $pr->update("active", " 'no' ", $productId);
    $request->aredirect("active-auction.php");
} else {
    $request->redirect("");
}
