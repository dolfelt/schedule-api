<?php

define('APP_PATH', realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR);

require APP_PATH . 'vendor/autoload.php';

$injector = new \Auryn\Injector();
$app = Spark\Application::boot($injector);

$init = $injector->make('App\Bootstrap');
$init->boot();

$app->setMiddleware([
    'Relay\Middleware\ResponseSender',
    'Spark\Handler\ExceptionHandler',
    'Spark\Handler\RouteHandler',
    'Spark\Handler\ActionHandler',
]);

$app->addRoutes(function(Spark\Router $r) {
    $r->get('/shifts', 'App\Domain\Shift\GetList');
    $r->get('/positions', 'App\Domain\Position\GetList');

});

$app->run();
