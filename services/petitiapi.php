<?php
require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/petiti-api', function (Request $request, Response $response, $args) {
    $response->getBody()->write("sim");
    return $response;
});

$app->run();
