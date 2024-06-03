<?php

namespace MazadEgypt\Classes\Validation;

class Max implements ValidationRole
{
    public function check(string $name, $value)
    {
        if (strlen($value) > 255) {
            return "$name Must Not Exceed 255 Characters";
        }
        return false;
    }
}
