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
require_once ROOT_DIR . '\app\foundation\FBiglietto.php';
require_once ROOT_DIR . '\app\entity\EBiglietto.php';

$app->post('/api/biglietto/add', function(ServerRequestInterface $request, ResponseInterface $response) use ($app) {
    $var=$request->getHeaders(); //ho l'header autorization
    $data = $request->getParsedBody();
    $idutente=$data['idutente'];
    $riepilogo=$data['riepilogo'];
    $f = new FBiglietto();
    $b = new EBiglietto();
    $b->costruttore($riepilogo, $idutente);
    $f->store($b);
    $response = json_encode($b);
    return $response;
});

