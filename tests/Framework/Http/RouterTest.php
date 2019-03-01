<?php

namespace Tests\Framework\Http;

use Framework\Http\Request\Exception\RequestNotMatchedException;
use Framework\Http\Router\RouteCollection;
use Framework\Http\Router\Router;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class RouterTest extends TestCase
{
    public function testCorrectMethod()
    {
        $routes = new RouteCollection();

        $routes->get($nameGet = 'blog', '/blog', $handlerGet = 'handler_get');
        $routes->post($namePost = 'blog_edit', '/blog', $handlerPost = 'handler_post');

        $router = new Router($routes);

        $result = $router->match(this->buildRequest('GET', '/blog'));
        self::assertEquals($nameGet, $result->getName());
        self::assertEquals($handlerGet, $result->getHandler());

        $result = $router->match($this->buildRequest('POST'), '/blog');
        self::assertEquals($namePost, $result->getName());
        self::assertEquals($handlerPost, $result->getHandler());
    }

    public function buildRequest(string $method, string $uri): ServerRequest
    {
        return (new ServerRequest())
            ->withMethod($method)
            ->withUri($uri);
    }
}
