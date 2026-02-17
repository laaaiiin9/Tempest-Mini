<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

$string = "/users/{id}";

// $pattern = preg_replace('#\{([a-zA-Z]+)\}#', '(\d+)', $string);
// $pattern = "#^" . $pattern . "$#";

// echo $pattern . '<br>';

// preg_match($pattern, $uri, $matches);

// echo $matches[1] . '<br>';

$routes = array();
$routes['/']['GET'] = 'home';
$routes['/users']['GET'] = 'users';
$routes['/users/{id}']['GET'] = 'users';

$route_found = false;

foreach ($routes as $path => $method) {

    $inspectUri = $path;

    $pattern = preg_replace('#\{([a-zA-Z]+)\}#', '(\d+)', $inspectUri);
    $pattern = "#^" . $pattern . "$#";

    if (preg_match($pattern, $uri, $matches)) {
        echo 'true';
    }

}

if (!$route_found) {
    //echo 'Page not found';
}