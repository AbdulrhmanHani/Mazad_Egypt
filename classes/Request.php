<?php

namespace MazadEgypt\Classes;

class Request
{
    public function get(string $key)
    {
        return $_GET[$key];
    }

    public function post(string $key)
    {
        return $_POST[$key];
    }

    public function postClean(string $key)
    {
        return trim(htmlspecialchars($key));
    }

    public function getHas(string $key): bool
    {
        return isset($_GET[$key]);
    }

    public function postHas(string $key): bool
    {
        return isset($_POST[$key]);
    }

    public function img($key)
    {
        return $_FILES[$key];
    }

    public function redirect($path)
    {
        header("location: " . URL . $path);
    }

    public function aredirect($path)
    {
        header("location: " . AURL . $path);
    }
}
