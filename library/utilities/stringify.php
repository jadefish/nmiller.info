<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

function stringify($thing): string
{
    if (is_array($thing)) {
        return print_r($thing, true);
    } else {
        if (is_object($thing)) {
            if (method_exists($thing, "__toString")) {
                return (string)$thing;
            }

            return print_r($thing, true);
        } else {
            if ($thing === null) {
                return "null";
            } else {
                if (is_bool($thing)) {
                    return $thing ? "true" : "false";
                }
            }
        }
    }

    return $thing;
}
