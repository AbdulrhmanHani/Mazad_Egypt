<?php

use MazadEgypt\Classes\Models\Admin;

require_once("../app.php"); ?>
<?php
if ($session->has("admin")) {
  $n = $session->get("admin");
  $ad = new Admin;
  $admin = $ad->selectWhere("name = '$n'")[0];
} else {
  $request->aredirect("login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MazadEgypt | Dashboard</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= AURL; ?>"><span class="text-info">M</span>azad <span class="text-info">E</span>gypt</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>categories.php"><span class="text-warning">C</span>ategories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>users.php"><span class="text-info">U</span>sers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>admins.php"><span class="text-success">A</span>dmins</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>products.php"><span class="text-secondary">P</span>ending Auctions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>active-auction.php"><span class="text-secondary">A</span>ctive Auctions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>ended-auction.php"><span class="text-danger">E</span>nded Auctions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>orders.php"><span class="text-info">A</span>ppoved Auctions</a>
        </li>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>messages.php"><span class="text-warning">M</span>essages</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= AURL; ?>profits.php"><span class="text-success">P</span>rofits</a>
        </li>

      </ul>
      <ul class="navbar-nav ml-auto mr-5">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php if ($admin['is_super'] == "yes") { ?>
              <?= $session->get("admin") . "<span class='text-success'> | Super Admin</span>"; ?>
            <?php } else { ?>
              <?= $session->get("admin") . "<span class='text-info'> | Admin</span>"; ?>
            <?php } ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= AURL . "profile.php"; ?>">Profile</a>
            <a class="dropdown-item" href="handlers/logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>