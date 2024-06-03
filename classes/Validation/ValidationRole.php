<?php

namespace MazadEgypt\Classes\Validation;

interface ValidationRole
{
    public function check(string $name, $value);
}