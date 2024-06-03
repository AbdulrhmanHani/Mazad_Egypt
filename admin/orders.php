<?php

use MazadEgypt\Classes\Models\Order;

require_once('inc/header.php');
$or = new Order;
$orders = $or->selectAll();
?>
<div class="container-fluid py-5">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Approved Orders</h3>
      </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Owner Name</th>
            <th scope="col">Owner Email</th>
            <th scope="col">Owner Phone</th>
            <th scope="col">Owner Address</th>
            <th scope="col">Winner Name</th>
            <th scope="col">Winner Email</th>
            <th scope="col">Winner Phone</th>
            <th scope="col">Winner Address</th>
            <th scope="col">Product Name</th>
            <th scope="col">Total</th>
            <th scope="col">Time</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orders as $index => $order) { ?>
            <tr>
              <th scope="row text-center"><?= $index + 1 ?></th>
              <td><?= $order['creator_name']; ?></td>
              <td><?= $order['creator_email']; ?></td>
              <td><?= $order['creator_phone']; ?></td>
              <td><?= $order['creator_address']; ?></td>
              <td><?= $order['winner_name']; ?></td>
              <td><?= $order['winner_email']; ?></td>
              <td><?= $order['winner_phone']; ?></td>
              <td><?= $order['winner_address']; ?></td>
              <td><?= $order['product']; ?></td>
              <td><?= $order['last_price'] + ($order['last_price'] * (5/100)) . " L.E"; ?></td>
              <td><?= $order['created_at']; ?></td>
              <td>
                <a class="btn btn-sm btn-success" title="Order Has Arrived" href="<?= AURL . "handlers/order-details.php?id=" . $order['id']; ?>">
                  <i class="fa fa-thumbs-up m-2"></i>
                </a>
                <a class="btn btn-sm btn-info" title="Out For Delevery" href="<?= AURL . "orders.php"?>">
                  <i class="fa fa-truck m-2" style="font-size: small;"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>
<?php require_once("inc/footer.php"); ?>