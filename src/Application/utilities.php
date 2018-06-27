<?php

use Application\Application;

if (!function_exists('app')) {
    function app(string $key = null)
    {
        $instance = Application::getInstance();

        if ($key) {
            return $instance->get($key);
        }

        return $instance;
    }
}

if (!function_exists('request')) {
    function request()
    {
        return app('request');
    }

}

if (!function_exists('response')) {
    function response(int $status, $body = null)
    {
        $class = app('response');

        return new $class($status, [], $body);
    }
}
