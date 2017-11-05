<?php

chdir(__DIR__);

define("APPLICATION_PATH", realpath(__DIR__ . "/../application"));
define("LIBRARY_PATH", realpath(__DIR__ . "/../library"));
define("PRIVATE_ROOT", realpath(__DIR__ . "/.."));
define("PUBLIC_ROOT", realpath(__DIR__));

require_once LIBRARY_PATH . "/utilities/path.php";

// Autoload unprefixed class names from /library:
$autoloader = require path(LIBRARY_PATH, "/utilities/autoloader.php");
spl_autoload_register($autoloader(LIBRARY_PATH));

Bootstrap::init([
    "envFile" => path(PRIVATE_ROOT, ".env"),
    "configDir" => path(APPLICATION_PATH, "config")
]);
