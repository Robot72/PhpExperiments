<?php

namespace Framework\Http\Router;

class RouteCollection
{
    private $routes = [];

    /**
     */
    public function get($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes = new Route($name, $pattern, $handler, ['GET'], $tokens);
    }

    public function post($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes = new Route($name, $pattern, $handler, ['POST'], $tokens);
    }

    public function any($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes = new Route($name, $pattern, $handler, [], $tokens);
    }

    public function getRouter()
    {
        return $this->routes;
    }

}