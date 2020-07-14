<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

require_once 'C:\xampp\htdocs\progetto\cinema\app\config\config.php';
require ROOT_DIR.'\vendor\autoload.php';

$app = new \Slim\App([
    'setting' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => true,
        'debug'               => true,
    ]
]);

require_once ROOT_DIR.'\app\controller\CUser.php'; 
require_once ROOT_DIR.'\app\controller\CFilm.php';
require_once ROOT_DIR.'\app\controller\CMappa.php';
require_once ROOT_DIR.'\app\controller\CProiezioni.php';
require_once ROOT_DIR.'\app\controller\CSala.php';

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->run();

