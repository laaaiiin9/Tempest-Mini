<?php

define('BASE_PATH', __DIR__);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

require BASE_PATH . '/core/Router.php';

$router = new Router();
require BASE_PATH . '/routes/web.php';

$router->dispatch($uri, $request_method);