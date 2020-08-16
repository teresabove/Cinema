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
require ROOT_DIR . '\vendor\autoload.php';

$app = new \Slim\App([
    'setting' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => true,
        'debug' => true,
    ]
        ]);

require_once ROOT_DIR . '\app\controller\CUser.php';
require_once ROOT_DIR . '\app\controller\CFilm.php';
require_once ROOT_DIR . '\app\controller\CMappa.php';
require_once ROOT_DIR . '\app\controller\CProiezioni.php';
require_once ROOT_DIR . '\app\controller\CSala.php';
require_once ROOT_DIR . '\app\controller\CBiglietto.php';
require_once ROOT_DIR . '\app\controller\CPosto.php';
require_once ROOT_DIR . '\app\controller\CSconto.php';

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/api/prova', function(Request $request, Response $response) {
    //$array=$request->getHeaders();
    $authHeader = $request->getHeader('HTTP_AUTHORIZATION');
    if ($authHeader) {
        $authHeaders = implode($authHeader);
        $s=list($jwt) = sscanf($authHeaders, 'Authorization: Bearer %s');
        $response = json_encode($s);
        if ($jwt){
                global $config;
                $secretKey = base64_decode($config['secretkey']);
                $token = JWT::decode($jwt, $secretKey);
                $res =$token;
                $response = json_encode($s);            
        }
    }
    return $response;
});

$app->get('/api/prova2', function(Request $request, Response $response) {
    //$array=$request->getHeaders();
    $authHeader = $request->getHeader('HTTP_AUTHORIZATION');
    $response = json_encode($authHeader);
    return $response;
});


$app->run();

