<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

function stringify($thing): string
{
    if (is_array($thing)
        || is_object($thing) && !method_exists($thing, "__toString")) {
        return print_r($thing, true);
    }

    if (is_bool($thing)) {
        return $thing ? "true" : "false";
    }

    if (is_null($thing)) {
        return "null";
    }

    if (is_resource($thing)) {
        return sprintf("resource(%s)", get_resource_type($thing));
    }

    return (string)$thing;
}
