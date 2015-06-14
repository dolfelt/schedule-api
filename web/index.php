<?php

define('APP_PATH', realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR);

require APP_PATH . 'vendor/autoload.php';

$boot = new \App\Bootstrap();

$app = Spark\Application::boot($boot->getInjector());

$app->addRoutes(function(Spark\Router $r) {
    $r->get('/shifts', 'App\Domain\Shift\GetList');
});

$app->run();
