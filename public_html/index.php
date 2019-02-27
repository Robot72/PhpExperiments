<?php

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

// Initialization

function getErrorResponse() {
    return new JsonResponse(['error' => 'Unfound page'], 404);
}
$request = ServerRequestFactory::fromGlobals();

// Action
$path = $request->getUri()->getPath();

if ($path === '/') {
    $action = function (ServerRequestInterface $request) {
        $name = $request->getQueryParams()['name'] ?? 'Guest';
        $response = new HtmlResponse('Hello ' . $name . '!');
        return $response;
    };
} else if ($path === '/about') {
    $action = function (ServerRequestInterface $request) {
        $response = new HtmlResponse('I am developer :)');
        return $response;
    };
} else if (preg_match('#^/blog/(?P<id>\d+)$#i', $path, $matches)) {
    $request = $request->withAttribute('id', $matches['id']);

    $action = function (ServerRequestInterface $request) {
        $id = $request->getAttribute('id');

        if ($id > 2) {
            $response = getErrorResponse();
        } else {
            $response = new JsonResponse(['id' => $id, 'title' => 'Post #' . $id]);
        }
        return $response;
    };
}

if ($action) {
    $response = $action($request);
} else {
    $response = getErrorResponse();
}

// Postprocessing
$response->withHeader('X-Developer', 'Robert Kuznetsov');

// Sending

(new SapiEmitter())->emit($response);
