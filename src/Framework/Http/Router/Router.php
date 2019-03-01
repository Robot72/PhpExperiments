<?php


namespace Framework\Http\Router;


use Psr\Http\Message\ServerRequestInterface;

class Router
{
    private $routes;

    public function __construct(RouteCollection $collection)
    {
        $this->routes = $collection;
    }

    public function match(ServerRequestInterface $request)
    {
        return new Result($name, $handler, $attributes);
    }
}