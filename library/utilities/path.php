<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

function path(string ...$fragments): string
{
    if (empty($fragments)) {
        return ".";
    }

    $path = implode(
        DIRECTORY_SEPARATOR,
        array_filter(array_map(function(string $fragment): string {
            return trim($fragment);
        }, $fragments))
    );

    return preg_replace("@/+@", "/", $path);
}
