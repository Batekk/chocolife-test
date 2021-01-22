<?php

namespace TaskApp;

class Request
{
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function uri()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }
}
