<?php

define('BASE_PATH', dirname(__DIR__));

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

require BASE_PATH . '/core/App.php';

$app = new App();
$app->run();
$app->router->dispatch($uri, $request_method);