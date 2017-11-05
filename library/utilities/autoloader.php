<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

return function(string $base, string $namespace = ""): callable {
    $len = mb_strlen($namespace);

    return function(string $className) use ($namespace, $base, $len): void {
        // Non-matching prefix; use next registered autoloader function:
        if (strncmp($namespace, $className, $len) !== 0) {
            return;
        }

        $class = mb_substr($className, $len);
        $filename = $base . "/" . str_replace("\\", "/", $class) . ".php";

        if (file_exists($filename)) {
            require $filename;
        }
    };
};
