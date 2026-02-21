<?php

class Router
{

    protected $routes = array();

    public function addRouter($uri, $method, $action): RouteDefinition
    {
        $normalizedMethod = strtoupper($method);

        $this->routes[$uri][$normalizedMethod] = [
            'action' => $action,
            'rate_limit' => null,
        ];

        return new RouteDefinition($this, $uri, $normalizedMethod);
    }

    public function setRateLimit(string $uri, string $method, int $maxAttempts, int $decaySeconds): void
    {
        if (!isset($this->routes[$uri][$method])) {
            return;
        }

        $this->routes[$uri][$method]['rate_limit'] = [
            'max_attempts' => $maxAttempts,
            'decay_seconds' => $decaySeconds,
        ];
    }

    public function dispatch($uri, $request_method)
    {
        $route_found = false;
        $normalizedMethod = strtoupper($request_method);

        foreach ($this->routes as $path => $methods) {

            if (!isset($methods[$normalizedMethod])) {
                continue;
            }

            $route = $methods[$normalizedMethod];
            $inspectUri = $path;

            $pattern = preg_replace('#\{([a-zA-Z]+)\}#', '(\d+)', $inspectUri);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                $route_found = true;

                if (!$this->passesRateLimit($path, $normalizedMethod, $route['rate_limit'])) {
                    return;
                }

                array_shift($matches);
                //print_r($matches);

                $actions = explode('@', $route['action']);
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
            //Response::abort('error_pages/404', ['error_code' => 404], 404)->layout('errors');
            //Response::abort(404, 'Page could not be found');
            View::abort('errors/404', ['error_code' => 404]);
        }
    }

    private function passesRateLimit(string $path, string $method, ?array $rateLimit): bool
    {
        if (empty($rateLimit)) {
            return true;
        }

        $maxAttempts = (int) ($rateLimit['max_attempts'] ?? 0);
        $decaySeconds = (int) ($rateLimit['decay_seconds'] ?? 0);

        if ($maxAttempts < 1 || $decaySeconds < 1) {
            return true;
        }

        $clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $rateKey = sprintf('%s:%s:%s', $method, $path, $clientIp);

        if (RateLimiter::tooManyAttempts($rateKey, $maxAttempts, $decaySeconds)) {
            $retryAfter = RateLimiter::availableIn($rateKey, $decaySeconds);

            if (session_status() === PHP_SESSION_ACTIVE) {
                $_SESSION['errors']['rate_limit'] = ["Too many attempts. Try again in {$retryAfter} seconds."];
            }

            http_response_code(429);
            header("Retry-After: {$retryAfter}");

            if ($method === 'POST' && $this->canRedirectToReferer()) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Too many attempts. Try again in {$retryAfter} seconds.";
            }

            return false;
        }

        RateLimiter::hit($rateKey, $decaySeconds);
        return true;
    }

    private function canRedirectToReferer(): bool
    {
        if (empty($_SERVER['HTTP_REFERER'])) {
            return false;
        }

        $refererHost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        $currentHost = $_SERVER['HTTP_HOST'] ?? '';

        return !empty($refererHost) && !empty($currentHost) && $refererHost === $currentHost;
    }

}
