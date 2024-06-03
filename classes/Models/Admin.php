<?php

namespace MazadEgypt\Classes\Models;

use MazadEgypt\Classes\Db;

class Admin extends Db
{
    public function __construct()
    {
        $this->table = "admins";
        $this->connect();
    }
}
