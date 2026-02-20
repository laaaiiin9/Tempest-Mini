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

                $actions = explode('@', $methods[$request_method]);
                [$controller, $function] = $actions;

                $controllerPath = BASE_PATH . '/controllers/' . $controller . '.php';

                if (!file_exists($controllerPath)) {
                    echo "Controller ({$controller}) does not exist in the path.";
                    return;
                }

                require BASE_PATH . '/controllers/Controller.php';
                require $controllerPath;

                $controllerParts = explode('/', $controller);
                $className = end($controllerParts);

                $controllerNew = new $className(DB::getDb());

                if (!method_exists($controllerNew, $function)) {
                    echo "Method ({$function}) does not exist on the Controller ({$controller}).";
                    return;
                }

                if (!empty($matches)) {
                    call_user_func_array([$controllerNew, $function], $matches);
                } else {
                    $controllerNew->$function();
                }

                break;
            }

        }

        if (!$route_found) {
            //echo 'Page not found';
            Response::abort('error_pages/404', ['error_code' => 404])->layout('errors');
            //Response::abort(404, 'Page could not be found');
        }
    }

}