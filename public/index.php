<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

chdir(__DIR__);

require '../vendor/autoload.php';

$app = new \Elu\Application(__DIR__ . '/../');
$app->bootstrap();

$handler = function (int $var1, string $var2) {
    var_dump(request(), get_defined_vars());
};

$router = $app->router;
$router->post('/foo/bar/baz/{var1:int}/{var2:string}', function () {
    echo 'POST';
});
$router->delete('/foo/bar/baz/{var1:int}/{var2:string}', $handler);
$router->get('/', function () {
    echo "home";
});

$app->run();
