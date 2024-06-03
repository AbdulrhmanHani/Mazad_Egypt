<?php

namespace MazadEgypt\Classes\Models;

use MazadEgypt\Classes\Db;

class Order extends Db
{
    public function __construct()
    {
        $this->table = "orders";
        $this->connect();
    }
}