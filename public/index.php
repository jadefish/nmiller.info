<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

chdir(__DIR__);

define("PRIVATE_ROOT", realpath(__DIR__ . "/.."));
define("APPLICATION_PATH", realpath(PRIVATE_ROOT . "/application"));
define("LIBRARY_PATH", realpath(PRIVATE_ROOT . "/library"));
define("PUBLIC_ROOT", realpath(__DIR__));

require_once LIBRARY_PATH . "/utilities/path.php";

$autoloader = require path(LIBRARY_PATH, "/utilities/autoloader.php");

spl_autoload_register($autoloader(LIBRARY_PATH));
spl_autoload_register($autoloader(PRIVATE_ROOT));

use \Framework\{Bootstrap, Logger, Router};

Bootstrap::init([
    "envFile" => path(PRIVATE_ROOT, ".env"),
    "configDir" => path(APPLICATION_PATH, "config")
]);

$router = (new Router())
    ->add("index", "/test/@id:(\d+)", [Application\Controllers\IndexController::class, "index"])
    ->start();
