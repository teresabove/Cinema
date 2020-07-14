<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

require_once 'C:\xampp\htdocs\progetto\cinema\app\config\config.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\foundation\FSala.php';
require_once ROOT_DIR.'\app\entity\ESala.php';

$app->get('/api/sala/{nomesala}', function(ServerRequestInterface $request, ResponseInterface $response, $args){
    $nomesala=$args['nomesala'];
    $f = new FSala();
    $res=$f->load($nomesala);
    $response= json_encode($res);
    return $response;
});

