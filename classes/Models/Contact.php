<?php

namespace MazadEgypt\Classes\Models;

use MazadEgypt\Classes\Db;

class Contact extends Db
{
    public function __construct()
    {
        $this->table = "contact";
        $this->connect();
    }
}