<?php

namespace Framework;

use \Framework\Router\Route;
use \Framework\Router\RouteMatch;

final class Router extends Emitter
{
    const DEFAULT_PREFIX = "/";

    private $prefix = self::DEFAULT_PREFIX;
    private $routes = [];
    private $started = false;

    public function __construct($prefix = self::DEFAULT_PREFIX)
    {
        $this->prefix = (string)$prefix;
    }

    private function dispatch(string $fragment): void
    {
        $match = $this->matchFragment($fragment);
        $route = $match->route;
        $arguments = $match->arguments;

        $route->invoke($arguments);
    }

    private function matchFragment(string $fragment): RouteMatch
    {
        foreach ($this->routes as $name => $route) {
            $pattern = $route->getPattern();
            $arguments = [];

            if (preg_match($pattern, $fragment, $arguments)) {
                return new RouteMatch($route, $arguments);
            }
        }

        // TODO: sane default?
        throw new \Exception("Invalid route specified");
    }

    public function add(string $name, string $pattern, $handler): Router
    {
        [$class, $method] = $handler;
        $this->routes[$name] = new Route($pattern, $class, $method);

        return $this;
    }

    public function remove(string $name): Router
    {
        unset($this->routes[$name]);

        return $this;
    }

    public function start(): Router
    {
        if (!$this->started) {
            $this->dispatch($_SERVER["REQUEST_URI"]);
            $this->started = true;
        }

        return $this;
    }
}
