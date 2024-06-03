<?php

namespace MazadEgypt\Classes\Models;

use MazadEgypt\Classes\Db;

class Cat extends Db
{
    public function __construct()
    {
        $this->table = "cats";
        $this->connect();
    }
}