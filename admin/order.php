<?php

use MazadEgypt\Classes\Models\Auction;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;

require_once('../app.php');
require_once('inc/header.php');

$pr = new Product;
$us = new User;
$au = new Auction;


if ($request->getHas("id")) {
  $productId = $request->get("id");
  $product = $pr->selectId($productId);
  $productOwnerId = $product['product_owner'];

  $productOwner = $us->selectId($productOwnerId);

  $auctions = $au->selectWhere("product_id = $productOwnerId");


  // last input in Auction
  $aUCTIONS = $au->selectWhere("product_id = $productId");
  $auction = end($aUCTIONS);

  //winner in This Auction
  $winnerUserID = $auction['user_id'];
  $winnerUser = $us->selectId($winnerUserID); //# User


?>
  <div class="container-fluid py-5">
    <div class="row">

      <div class="col-md-6 offset-md-3">
        <h3 class="mb-3">Show Order : <span class="text-info"> <?= $product['name']; ?></span></h3>
        <div class="card">
          <div class="card-body p-5">
            <table class="table table-bordered">
              <thead>
                <th colspan="2" class="text-center">Details</th>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Creator</th>
                  <td><?= $productOwner['name']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Creator Email</th>
                  <td><?= $productOwner['email']; ?></td>
                </tr>
                <th scope="row">Creator Address</th>
                <td><?= $productOwner['address']; ?></td>
                </tr>
                <th scope="row">Creator Phone Number</th>
                <td><?= $productOwner['phone']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Winner</th>
                  <td><?= $winnerUser['name']; ?></td>
                </tr>
                <th scope="row">Winner Email</th>
                <td><?= $winnerUser['email']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Winner Address</th>
                  <td><?= $winnerUser['address']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Winner Phone Number</th>
                  <td><?= $winnerUser['phone']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Created At</th>
                  <td><?= $product['created_at']; ?></td>
                </tr>
                <th scope="row">Finished At</th>
                <td><?= $auction['added_at']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Status</th>
                  <td>Winner of Mazad <?= $product['name']; ?></td>
                </tr>
              </tbody>
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Mazad Name</th>
                  <th>Mazad Winner</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Profit</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?= $product['name']; ?></td>
                  <td><?= $winnerUser['name']; ?></td>
                  <td>1</td>
                  <td><?= $auction['price']; ?> L.E</td>
                  <td><?= $auction['price'] * 5 / 100; ?> L.E</td>
                </tr>
              </tbody>
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Total</th>
                  <th>Change Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?= $auction['price'] + ($auction['price'] * (5 / 100)); ?> L.E</td>
                  <td>
                    <a class="btn btn-success" href="<?= AURL . "handlers/approve.php?id=" . $productId . "&creator_name=" . $productOwner['name'] . "&creator_email=" . $productOwner['email'] . "&creator_address=" . $productOwner['address'] . "&creator_phone=" . $productOwner['phone'] . "&winner_name=" . $winnerUser['name'] . "&winner_email=" . $winnerUser['email'] . "&winner_phone=" . $winnerUser['phone'] . "&winner_address=" . $winnerUser['address'] . "&product=" . $product['name'] . "&last_price=" . $auction['price']; ?>">Approve</a>
                    <a class="btn btn-danger" href="<?= AURL . "handlers/cancel.php?id=" . $productId; ?>">Cancel</a>
                  </td>
                </tr>
              </tbody>
            </table>

            <a class="btn btn-dark" href="<?= AURL . "ended-auction.php"; ?>">Back</a>
          </div>
        </div>
      </div>

    </div>
  </div>
  <?php require_once("inc/footer.php"); ?>
<?php } ?>