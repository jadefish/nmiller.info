<?php

function stringify($thing): string
{
    if (is_array($thing)) {
        return print_r($thing, true);
    } else if (is_object($thing)) {
        if (method_exists($thing, "__toString")) {
            return (string)$thing;
        }

        return print_r($thing, true);
    } else if (is_null($thing)) {
        return "null";
    } else if (is_bool($thing)) {
        return $thing ? "true" : "false";
    }

    return $thing;
}
