<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

//require_once 'C:\xampp\htdocs\progetto\cinema\app\config\config.php';
require_once 'app\foundation\FMappa.php';
require_once 'app\entity\EMappa.php';

$app->get('/api/mappa/{nomeschema}', function(ServerRequestInterface $request, ResponseInterface $response, $args){
    $nomeschema=$args['nomeschema'];
    $f = new FMappa();
    $res=$f->load($nomeschema);
    $response= json_encode($res);
    return $response;
});

