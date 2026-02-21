<?php

class RouteDefinition
{
    private Router $router;
    private string $uri;
    private string $method;

    public function __construct(Router $router, string $uri, string $method)
    {
        $this->router = $router;
        $this->uri = $uri;
        $this->method = $method;
    }

    public function rateLimit(int $maxAttempts, int $decaySeconds): self
    {
        $this->router->setRateLimit($this->uri, $this->method, $maxAttempts, $decaySeconds);
        return $this;
    }
}
