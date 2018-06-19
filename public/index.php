<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

chdir(__DIR__);

require '../vendor/autoload.php';

$app = new \Elu\Application(__DIR__ . '/../');
$app->withRoutes('application/routes.php');
$app->bootstrap();

var_dump($app);
