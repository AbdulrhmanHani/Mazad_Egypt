<?php
require_once("../../app.php");

use MazadEgypt\Classes\Models\Auction;
use MazadEgypt\Classes\Models\Product;

$au = new Auction;
$pr = new Product;

if ($request->getHas("id")) {
    $productID = $request->get("id");

    $auctionProductIds = $au->selectWhere("product_id = $productID");

    foreach ($auctionProductIds as $auctionProductId) {
        $au->delete($auctionProductId['id']);
    }
    $pr->delete("$productID");

    $request->aredirect("ended-auction.php");
} else {
    $request->redirect("");
}
