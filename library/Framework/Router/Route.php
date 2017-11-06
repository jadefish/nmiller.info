<?php

namespace Framework\Router;

require_once LIBRARY_PATH . "/utilities/call_user_func_named_array.php";

final class Route
{
    private $class = null;
    private $method = null;
    private $pattern = null;

    private static $ANCHOR_CHARACTERS = "^$";

    public function __construct(
        string $pattern,
        string $class,
        string $method
    ) {
        $this->pattern = self::createExpression($pattern);
        $this->class = $class;
        $this->method = $method;
    }

    private static function createExpression(string $pattern): string
    {
        $expression = trim($pattern, self::$ANCHOR_CHARACTERS);
        $expression = preg_replace(
            "/@(\w+):\((.*?)\)/",
            "(?P<$1>$2)",
            $expression
        );

        return "@^{$expression}$@u";
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function invoke(array $args = [])
    {
        $class = new $this->class();

        return call_user_func_named_array(
            $class,
            $this->method,
            $args
        );
    }
}
