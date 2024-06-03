<?php

namespace MazadEgypt\Classes\Models;

use MazadEgypt\Classes\Db;

class Auction extends Db
{
    public function __construct()
    {
        $this->table = "auction";
        $this->connect();
    }
}
