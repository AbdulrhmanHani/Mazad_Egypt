<?php

namespace MazadEgypt\Classes\Models;

use MazadEgypt\Classes\Db;

class User extends Db
{
    public function __construct()
    {
        $this->table = "users";
        $this->connect();
    }
}
