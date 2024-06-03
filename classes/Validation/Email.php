<?php

namespace MazadEgypt\Classes\Validation;

class Email implements ValidationRole
{
    public function check(string $name, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "Must Be Valid $name ";
        }
        return false;
    }
}
