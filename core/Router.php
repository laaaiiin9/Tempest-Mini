<?php

class Router
{

    protected $routes = array();

    public function addRouter($uri, $method, $action): void
    {
        $this->routes[$uri][$method] = $action;
    }

    public function dispatch($uri, $request_method)
    {
        $route_found = false;

        foreach ($this->routes as $path => $methods) {

            if (!isset($methods[$request_method])) {
                continue;
            }

            $inspectUri = $path;

            $pattern = preg_replace('#\{([a-zA-Z]+)\}#', '(\d+)', $inspectUri);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                $route_found = true;
                array_shift($matches);
                //print_r($matches);

                if (!empty($matches)) {
                    echo $methods[$request_method];
                } else {
                    echo $methods[$request_method];
                }

                break;
            }

        }

        if (!$route_found) {
            echo 'Page not found';
        }
    }

}