<?php

define('BASE_PATH', dirname(__DIR__));

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

$config_app = require BASE_PATH . '/config/app.php';
$config_db = require BASE_PATH . '/config/database.php';

require BASE_PATH . '/core/Config.php';

Config::set('app', $config_app);
Config::set('database', $config_db);

if (Config::get('app.env') === 'local') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
}

require BASE_PATH . '/core/Response.php';

set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

set_exception_handler(function ($exception) {
    //http_response_code(500);

    if (Config::get('app.env') === 'local') {
        Response::abort(500, '<pre>' . $exception . '<pre>');
        // echo "<pre>";
        // echo $exception;
        // echo "</pre>";
    } else {
        Response::abort(500, 'Server Error');
        //echo renderView('errors/500');
    }

    exit;
});

require BASE_PATH . '/db/DB.php';
DB::initDb();
// var_dump(DB::getDb());
// $db = DB::getDb();
//$db = require BASE_PATH . '/db/DB.php';

require BASE_PATH . '/core/Router.php';

$router = new Router();
require BASE_PATH . '/routes/web.php';

$router->dispatch($uri, $request_method);
