<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

chdir(__DIR__);

require '../vendor/autoload.php';

define('APP_START', microtime(true));

register_shutdown_function(function () {
    define('APP_END', microtime(true));

    error_log(sprintf(
        "Done in %s ms",
        number_format((APP_END - APP_START) * 1000, 2)
    ));
});

$app = new \Elu\Application(__DIR__ . '/../');
$app->bootstrap();

$router = $app->router;
$router->get('/', function () {
    echo "home";
});

$app->run();
