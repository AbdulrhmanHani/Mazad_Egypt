<?php

namespace MazadEgypt\Classes\Models;

use MazadEgypt\Classes\Db;

class Product extends Db
{
    public function __construct()
    {
        $this->table = "products";
        $this->connect();
    }
}
