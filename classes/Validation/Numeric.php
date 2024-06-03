<?php

namespace MazadEgypt\Classes\Validation;

class Numeric implements ValidationRole
{
    public function check(string $name, $value)
    {
        if (!is_numeric($value)) {
            return "$name Must Contain Only Numbers";
        }
        return false;
    }
}
