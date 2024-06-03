<?php

use MazadEgypt\Classes\Models\Cat;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;

require_once('../app.php');
require_once('inc/header.php');
?>
<?php
$pr = new Product;
$products = $pr->selectAll();
$c = new Cat;
$us = new User;
?>
<div class="container-fluid py-5 text-center">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Pending Auctions</h3>
                <?php if ($session->has("auctionActivated")) { ?>
                    <h3 class="text-success"><?= $session->get("auctionActivated"); ?></h3>
                <?php } ?>
                <?php $session->remove("auctionActivated"); ?>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Auction Number</th>
                        <th scope="col">Name</th>
                        <th scope="col">القسم</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
                        <th scope="col">Pieces</th>
                        <th scope="col">Price</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $index => $product) { ?>
                        <?php
                        $catId = $product['cat_id'];
                        $catGetName = $c->selectId($catId);
                        $catName = $catGetName['name'];
                        $catArabicName = $catGetName['arabic_name'];
                        $productOwnerId = $product["product_owner"];
                        $user = $us->selectId($productOwnerId);
                        $userOwnerName = $user['name'];
                        ?>
                        <?php if ($product['active'] === "pending") { ?>
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
                                <td><?= $userOwnerName; ?></td>
                                <td><?= $product['created_at']; ?></td>
                                <td><?= $product['active']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" title="Start Auction" href="<?= AURL . "handlers/start-auction.php?id=" . $product['id']; ?>">
                                        <i class="fa fa-bullhorn m-2"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" title="Delete Product" href="<?= AURL . "handlers/remove-product.php?id=" . $product['id']; ?>">
                                        <i class="fas fa-trash m-2"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } else { ?>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php require_once("inc/footer.php"); ?>