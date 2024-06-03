<?php

use MazadEgypt\Classes\Models\Admin;
use MazadEgypt\Classes\Models\Cat;
use MazadEgypt\Classes\Models\Contact;
use MazadEgypt\Classes\Models\Order;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\Profit;
use MazadEgypt\Classes\Models\User;

require_once('inc/header.php'); ?>
<?php
$AD = new Admin;
$C = new Cat;
$U = new User;
$PR = new Product;
$or = new Order;
$co = new Contact;

$AdminCnt = $AD->getCount();
$CatsCnt = $C->getCount();
$UsersCnt = $U->getCount();
$ProductCnt = $PR->getCount();
$OrderCnt = $or->getCount();
$CoCnt = $co->getCount();

$prod = new Product;
$activeProductsCount = $prod->getCountReason("active = 'yes'");
$pendingProductsCount = $prod->getCountReason("active = 'pending'");
$endedProductsCount = $prod->getCountReason("active = 'no'");

// Profits
$pf = new Profit;
$profits = $pf->selectAll("SUM(profit) AS SPF");
$profitsCnt = $profits[0]['SPF'];
?>
<div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5><?= $UsersCnt; ?></h5>
                        <a href="<?= AURL . "users.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5><?= $CatsCnt; ?></h5>
                        <a href="<?= AURL . "categories.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Admins</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5><?= $AdminCnt; ?></h5>
                        <a href="<?= AURL . "admins.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Pending Auctions</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5><?= $pendingProductsCount; ?></h5>
                        <a href="<?= AURL . "products.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Active Auctions</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5><?= $activeProductsCount; ?></h5>
                        <a href="<?= AURL . "active-auction.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Ended Auctions</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5><?= $endedProductsCount; ?></h5>
                        <a href="<?= AURL . "ended-auction.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Approved Auctions</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5><?= $OrderCnt; ?></h5>
                        <a href="<?= AURL . "orders.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Messages</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5><?= $CoCnt; ?></h5>
                        <a href="<?= AURL . "messages.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg- mb-3" style="background-color: #097;">
                <div class="card-header">Profits</div>
                <div class="card-body">
                    <div class="card-text d-flex justify-content-between align-items-center">
                        <h5 class="bg-dark text-center" style="color: #fff;border-radius: 10%; width: auto; height: 25px;"><?= floor($profitsCnt) ?? 0; ?> L.E</h5>
                        <a href="<?= AURL . "profits.php"; ?>" class="btn btn-light">Show</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php require_once("inc/footer.php"); ?>