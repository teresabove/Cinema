<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Firebase\JWT\JWT;
require_once 'C:\xampp\htdocs\progetto\cinema\app\config\config.php';
require_once ROOT_DIR.'\app\foundation\FFilm.php';
require_once ROOT_DIR.'\app\entity\EFilm.php';

//prima i metodi statici e poi quelli con paramslog di apache, vale solo per i get

$app->get('/api/film/all',function(ServerRequestInterface $request, ResponseInterface $response){
    $f=new FFilm();
    $res=$f->loadallfilm();
    $response= json_encode($res);
    return $response;
});
$app->get('/api/film/{title}',function(ServerRequestInterface $request, ResponseInterface $response,array $args){
    $name = $args['title'];
    $f= new FFilm();
    $res=$f->load($name);
    $response=json_encode($res);
    return $response;
});

$app->post('/api/film/add', function(ServerRequestInterface $request, ResponseInterface $response) use ($app){
    $data=$request->getParsedBody();
    $tit=$data['titolo'];
    $reg=$data['regista'];
    $an=$data['anno'];
    $du=$data['durata'];
    $cp=$data['casaproduzione'];
    $tr=$data['trama'];
    $ffilm= new FFilm();
    $pfilm=new Efilm();
    $pfilm->costruttore($tit,$reg,$an,$du, $g=array("azione","drammatico","sentimentale"), $c=array("Tom Cruise","Kelly McGillis"),$cp,$tr);
    $ffilm->store($pfilm);
    $response=json_encode($pfilm);
    return $response;
});
//trovare get routes metodo
$app->get('/api/film/genere/{tipo}',function(ServerRequestInterface $request, ResponseInterface $response, array $args){
    $tipo=$args['tipo'];
    $f= new FFilm();
    $res=$f->searchbygenere($tipo,'a_generi');
    $response=json_encode($res);
    return $response;
});

$app->get('/api/film/cast/{attore}',function(ServerRequestInterface $request, ResponseInterface $response, array $args){
    $tipo=$args['attore'];
    $f= new FFilm();
    $res=$f->searchbygenere($tipo,'a_cast');
    $response=json_encode($res);
    return $response;
});



