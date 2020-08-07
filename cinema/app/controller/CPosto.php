<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
require_once 'C:\xampp\htdocs\progetto\cinema\app\config\config.php';
require_once ROOT_DIR.'\app\foundation\FPosto.php';
require_once ROOT_DIR.'\app\entity\EPosto.php';
use \Firebase\JWT\JWT;

  $app->post('/api/posto/add',function(ServerRequestInterface $request, ResponseInterface $response) use ($app) {
    $data = $request->getParsedBody();
    $fila=$data['fila'];
    $numero=$data['numero'];
    $occupato=$data['occupato'];
    $proiezione=$data['proiezione'];
    $fp= new FPosto();
    $p= new EPosto();
    $p->costruttore($fila,$numero,$occupato, $proiezione);
    $fp->store($p);    
    $response=json_encode($p);
    return $response;
     
});

$app->get('/api/posto/{idproiezione}', function(ServerRequestInterface $request, ResponseInterface $response, $args){
    $idproiezione=$args['idproiezione'];
    $fp = new FPosto();
    $res= $fp->load($idproiezione);
    $response = json_encode($res);
    return $response;
});
 
