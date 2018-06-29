<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Load environment:
try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    // Nope
}

// Create the app:
$app = new Laravel\Lumen\Application(realpath(__DIR__ . '/../'));

// Load configuration:
$app->configure('markdown');

// Register DI container bindings:
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// Register service providers:
$app->register(GrahamCampbell\Markdown\MarkdownServiceProvider::class);

// Alias facades:
if (!class_exists('Markdown')) {
    class_alias(GrahamCampbell\Markdown\Facades\Markdown::class, 'Markdown');
}

// Load routes:
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__ . '/../routes/web.php';
});

return $app;
