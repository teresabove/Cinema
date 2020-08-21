<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Firebase\JWT\JWT;

//require_once 'C:\xampp\htdocs\progetto\cinema\app\config\config.php';
require_once 'app\foundation\FBiglietto.php';
require_once 'app\entity\EBiglietto.php';

$app->post('/api/biglietto/add', function(ServerRequestInterface $request, ResponseInterface $response) use ($app) {
    global $config;
    $authHeader = $request->getHeader('Authorization');
    if ($authHeader) {
        $authHeaders = fdb::convert_to_string($authHeader);
        list($jwt) = sscanf($authHeaders, 'Bearer %s');
        if ($jwt) {
            $secretKey = base64_decode($config['secretkey']);
            $token = JWT::decode($jwt, $secretKey, array('HS512'));
            $data = $request->getParsedBody();
            $idutente = $data['idutente'];
            $riepilogo = $data['riepilogo'];
            $f = new FBiglietto();
            $b = new EBiglietto();
            $b->costruttore($riepilogo, $idutente);
            $f->store($b);
            $response = json_encode($b);
        } else {
            $response = json_encode('HTTP/1.0 400 Bad Request');
        }
    } else {
        $response = json_encode('HTTP/1.0 405 Method Not Allowed');
    }
    return $response;
});

$app->get('/api/biglietto/{idutente}', function(ServerRequestInterface $request, ResponseInterface $response, array $args) {
    global $config;
    $authHeader = $request->getHeader('Authorization');
    if ($authHeader) {
        $authHeaders = fdb::convert_to_string($authHeader);
        list($jwt) = sscanf($authHeaders, 'Bearer %s');
        if ($jwt) {
            $secretKey = base64_decode($config['secretkey']);
            $token = JWT::decode($jwt, $secretKey, array('HS512'));
            $idutente = $args['idutente'];
            $f = new Fbiglietto();
            $tickets = $f->loadbyId($idutente);
            $response = json_encode($tickets);
        } else {
            $response= json_encode('HTTP/1.0 400 Bad Request');
        }
    } else {
        $response = json_encode('HTTP/1.0 405 Method Not Allowed');
    }
    return $response;
});

