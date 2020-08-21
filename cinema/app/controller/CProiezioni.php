<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

//require_once 'C:\xampp\htdocs\progetto\cinema\app\config\config.php';
require_once 'app\foundation\FProiezione.php';
require_once 'app\entity\EProiezione.php';

$app->get('/api/proiezione/all', function(ServerRequestInterface $request, ResponseInterface $response, $args){
    $f = new FProiezione();
    $res=$f->getAll();
    $response= json_encode($res);
    return $response;
});

$app->post('/api/proiezione/add', function(ServerRequestInterface $request, ResponseInterface $response) use ($app){
    $data=$request->getParsedBody();
    $titolo=$data['titolo'];
    $sala=$data['sala'];
    $giorno=$data['giorno'];
    $mappaproiezione=$data['mappaproiezione'];
    $tipo=$data['tipo'];
    $fpro= new FProiezione();
    $ppro=new EProiezione();
    $ppro->costruttore($titolo,$sala,$giorno,$mappaproiezione, $tipo);
    $fpro->store($ppro);
    $response=json_encode($fpro);
    return $response;
});

$app->get('/api/proiezione/{titolo}', function(ServerRequestInterface $request, ResponseInterface $response, $args){
    $titolo=$args['titolo'];
    $f = new FProiezione();
    $res=$f->searchbytitolo($titolo);
    $response= json_encode($res);
    return $response;
});



