<?php

namespace MazadEgypt\Classes\Models;

use MazadEgypt\Classes\Db;

class Profit extends Db
{
    public function __construct()
    {
        $this->table = "profits";
        $this->connect();
    }
}
