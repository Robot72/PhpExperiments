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

}