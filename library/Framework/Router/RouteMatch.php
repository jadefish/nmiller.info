<?php

namespace Framework\Router;

// it's just a tuple
final class RouteMatch
{
    private $route = null;
    private $arguments = [];

    public function __construct(Route $route, array $arguments = [])
    {
        $this->route = $route;
        $this->arguments = $arguments;
    }

    public function __get(string $key)
    {
        return $this->$key ?? null;
    }
}
