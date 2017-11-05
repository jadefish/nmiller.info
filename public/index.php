<?php

chdir(__DIR__);

define("APPLICATION_PATH", realpath(__DIR__ . "/../application"));
define("LIBRARY_PATH", realpath(__DIR__ . "/../library"));
define("PRIVATE_ROOT", realpath(__DIR__ . "/.."));
define("PUBLIC_ROOT", realpath(__DIR__));

// Autoload unprefixed class names from /library:
$autoloader = require LIBRARY_PATH . "/utilities/autoloader.php";
spl_autoload_register($autoloader(LIBRARY_PATH));

Bootstrap::init([
    "envFile" => PRIVATE_ROOT . "/.env",
    "configDir" => APPLICATION_PATH . "/config"
]);
