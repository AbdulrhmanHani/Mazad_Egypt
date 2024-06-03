<?php

namespace MazadEgypt\Classes\Validation;

class Required implements ValidationRole
{
    public function check(string $name, $value)
    {
        if (empty($value)) {
            return "$name Is Required";
        }
        return false;
    }
}
