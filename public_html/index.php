<?php

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

// Initialization

$request = ServerRequestFactory::fromGlobals();

// Action
$path = $request->getUri()->getPath();

if ($path === '/') {
    $name = $request->getQueryParams()['name'] ?? 'Guest';
    $response = new HtmlResponse('Hello ' . $name . '!');
} else if ($path === '/about') {
    $response = new HtmlResponse('I am developer :)');
} else if (preg_match('#^/blog/(?P<id>\d+)$#i', $path, $matches)) {
    $id = $matches['id'];
    if ($id > 2) {
        $response = new JsonResponse(['error' => 'Undefined page'], 404);
    } else {
        $response = new JsonResponse(['id' => $id, 'title' => 'Post #' . $id]);
    }
} else {
    $response = new JsonResponse(['error' => 'Unfound page'], 404);
}

// Postprocessing
$response->withHeader('X-Developer', 'Robert Kuznetsov');

// Sending

(new SapiEmitter())->emit($response);
