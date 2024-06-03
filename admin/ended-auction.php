<?php

use MazadEgypt\Classes\Models\Cat;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;
use MazadEgypt\Classes\Models\Auction;

require_once('../app.php');
require_once('inc/header.php');
?>
<?php
$pr = new Product;
$products = $pr->selectAll();
$c = new Cat;
$us = new User;

$au = new Auction;

?>
<div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Ended Auctions</h3>
                <?php if ($session->has("auctionActivated")) { ?>
                    <h3 class="text-success"><?= $session->get("auctionActivated"); ?></h3>
                <?php } ?>
                <?php $session->remove("auctionActivated"); ?>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">القسم</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
                        <th scope="col">Pieces</th>
                        <th scope="col">First Price</th>
                        <th scope="col">Winner Price</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Winner</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Finished At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- add condition if product is ended in DB -->

                    <?php foreach ($products as $index => $product) { ?>
                        <?php
                        if ($product['active'] === "no") {
                            $productId = $product['id'];
                            $auctioN = $au->selectWhere("product_id = $productId");
                            $catId = $product['cat_id'];
                            $catGetName = $c->selectId($catId);
                            $catName = $catGetName['name'];
                            $catArabicName = $catGetName['arabic_name'];
                            $productOwnerId = $product["product_owner"];
                            $user = $us->selectId($productOwnerId);
                            $userOwnerName = $user['name'];
                            $auction = end($auctioN); //# Ended Auction
                            if (end($auctioN) == null) { ?>
                                <tr class="text-center">
                                    <th scope="row"><?= $index + 1 ?></th>
                                    <td><?= $product['name']; ?></td>
                                    <td><?= $catArabicName; ?></td>
                                    <td><?= $catName; ?></td>
                                    <td>
                                        <a href="<?= URL . "uploads/" . $product['img']; ?>">
                                            <img style="width: 200px;height: 80px;" title="View Image" src="<?= URL; ?>uploads/<?= $product['img']; ?>" alt="">
                                        </a>
                                    </td>
                                    <td><?= $product['pieces_no']; ?></td>
                                    <td>$<?= $product['price']; ?></td>
                                    <td>$<?= "0 L.E"; ?></td>
                                    <td><?= $userOwnerName; ?></td>
                                    <td><?= "No One Joined This Auction"; ?></td>
                                    <td><?= $product['created_at']; ?></td>
                                    <td><?= "No One Joined This Auction"; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-danger" title="Delete" href="<?= AURL . "handlers/cancel.php?id=" . $product['id']; ?>">
                                            <i class="fa fa-trash m-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } else {

                                //winner in This Auction
                                $winnerUserID = $auction['user_id'];
                                $winnerUser = $us->selectId($winnerUserID); //# User
                            ?>
                                <!-- add condition if product is ended in DB -->
                                <?php if ($product['active'] === "no") { ?>
                                    <tr class="text-center">
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td><?= $product['name']; ?></td>
                                        <td><?= $catArabicName; ?></td>
                                        <td><?= $catName; ?></td>
                                        <td>
                                            <a href="<?= URL . "uploads/" . $product['img']; ?>">
                                                <img style="width: 200px;height: 80px;" title="View Image" src="<?= URL; ?>uploads/<?= $product['img']; ?>" alt="">
                                            </a>
                                        </td>
                                        <td><?= $product['pieces_no']; ?></td>
                                        <td>$<?= $product['price']; ?></td>
                                        <td>$<?= $auction['price']; ?></td>
                                        <td><?= $userOwnerName; ?></td>
                                        <td><?= $winnerUser['name']; ?></td>
                                        <td><?= $product['created_at']; ?></td>
                                        <td><?= $auction['added_at']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary" title="Show Info" href="<?= AURL . "order.php?id=" . $product['id']; ?>">
                                                <i class="fa fa-info-circle m-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php require_once("inc/footer.php"); ?>