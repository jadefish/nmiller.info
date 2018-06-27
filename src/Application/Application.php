<?php

namespace Application;

use League\Container\Container;
use League\Container\ReflectionContainer;

class Application extends Container
{
    protected $basedir = null;
    protected static $instance = null;

    public function __construct(string $basedir)
    {
        parent::__construct();

        $this->delegate(new ReflectionContainer());

        $this->basedir = $basedir;
        $this->share('basedir', $this->basedir);

        static::$instance = $this;
    }

    public static function getInstance()
    {
        return static::$instance;
    }

    public function route(string $method, string $path, $handler)
    {
        $handler = function ($request, $response, array $args) use ($handler) {
            $result = $handler($request, $response, $args);

            if (is_a($result, get_class($this->get('response')))) {
                return $result;
            }

            $response->getBody()->write($result);

            return $response;
        };

        $this->get('router')->map(
            $method,
            $path,
            $handler
        );

        return $this;
    }

    public function run()
    {
        $response = $this->get('router')->dispatch(
            $this->get('request'),
            $this->get('response')
        );

        header(implode(' ', [
            'HTTP/' . $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        ]));

        foreach ($response->getHeaders() as $name => $values) {
            header($response->getHeaderLine($name));
        }

        echo (string)$response->getBody();
        exit;
    }
}
