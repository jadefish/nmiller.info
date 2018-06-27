<?php

require __DIR__ . '/../vendor/autoload.php';

define('APP_START', microtime(true));

$app = new Application\Application(realpath(__DIR__ . '/..'));
$app->share(Application\Application::class, $app);
$app->share('request', function () {
    return GuzzleHttp\Psr7\ServerRequest::fromGlobals();
});
$app->share('response', GuzzleHttp\Psr7\Response::class);
$app->share('router', function () use ($app) {
    return new League\Route\RouteCollection($app);
});
$app->share('storage_dir', realpath(app('basedir') . '/storage'));
$app->share('documents', function () use ($app) {
    return new Application\DocumentStore($app);
});
$app->share('wrapper', function () use ($app) {
    return new Application\Wrapper($app);
});

$app->route('GET', '/{path:.*}', function ($request, $response, $args) {
    $path = $request->getUri()->getPath();
    $path = $path === '/' ? 'index' : $path;
    $contents = null;

    try {
        $contents = app('documents')->get($path);
    } catch (\Application\Exceptions\FileNotFoundException $e) {
        return response(404, 'File not found');
    }

    return app('wrapper')->wrap($contents);
});

register_shutdown_function(function () {
    define('APP_END', microtime(true));
    $duration = number_format((APP_END - APP_START) * 1000, 3);

    error_log("Done in {$duration} ms");
});

$app->run();
