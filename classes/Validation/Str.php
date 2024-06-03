<?php

namespace MazadEgypt\Classes\Validation;

class Str implements ValidationRole
{
    public function check(string $name, $value)
    {
        if (!is_string($value)) {
            return "$name Must Be String";
        }
        return false;
    }
}
