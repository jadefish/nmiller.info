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

$handler = function (string $var = 'default', int $var2 = 0) {
    $contents = scandir(app()->baseDir() . '/storage');
    $links = array_map(function (string $f): string {
        return "<li><a href=\"{$f}\">{$f}</a>";
    }, array_filter($contents, function (string $f): bool {
        return $f[0] !== '.';
    }));

    echo '<ul>' . implode("\n", $links) . '</ul>';
};

$router = $app->router;
$router->get('/{path:any}', $handler);

$app->run();
