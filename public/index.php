<?php

define('BASE_PATH', dirname(__DIR__));

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

$config_app = require BASE_PATH . '/config/app.php';
$config_db = require BASE_PATH . '/config/database.php';

require BASE_PATH . '/core/Response.php';
$db = require BASE_PATH . '/db/DB.php';

require BASE_PATH . '/core/Router.php';

$router = new Router();
require BASE_PATH . '/routes/web.php';

$router->dispatch($uri, $request_method);