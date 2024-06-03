<?php
require_once("../../app.php");

use MazadEgypt\Classes\Models\Order;

$or = new Order;

if ($request->getHas("id")) {
    $orderId = $request->get("id");

    $or->delete($orderId);
    $request->aredirect("orders.php");
} else {
    $request->aredirect("orders.php");
}
