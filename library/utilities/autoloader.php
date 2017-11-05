<?php

return function(string $base, string $namespace = ""): callable {
    $len = strlen($namespace);

    return function(string $className) use ($namespace, $base, $len) {
        // Non-matching prefix; use next registered autoloader function:
        if (strncmp($namespace, $className, $len) !== 0) {
            return;
        }

        $class = substr($className, $len);
        $filename = $base . "/" . str_replace("\\", "/", $class) . ".php";

        if (file_exists($filename)) {
            require $filename;
        }
    };
};
