<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Firebase\JWT\JWT;

require_once 'app\foundation\FFilm.php';
require_once 'app\foundation\FRegistrazione.php';
require_once 'app\entity\EUtente.php';
require_once 'app\entity\EProfilo.php';
require_once 'app\foundation\FCredenziali.php';
require_once 'app\foundation\fdb.php';

//global $config;

$app->get('/api/jwt', function(ServerRequestInterface $request, ResponseInterface $response, array $args) {
    global $config;
    $authHeader = $request->getHeader('Authorization');
    if ($authHeader) {
        $authHeaders = fdb::convert_to_string($authHeader);
        list($jwt) = sscanf($authHeaders, 'Bearer %s');
        if ($jwt) {
            $secretKey = base64_decode($config['secretkey']);
            $token = JWT::decode($jwt, $secretKey, array('HS512'));
            //$idutente = $args['idutente'];
            $response = json_encode($token);
        } else {
            $response = json_encode('HTTP/1.0 400 Bad Request');
        }
    } else {
        $response = json_encode('HTTP/1.0 405 Method Not Allowed');
    }
    return $response;
});

$app->get('/api/profilo/credenziale/{idutente}', function(ServerRequestInterface $request, ResponseInterface $response, array $args) {
    global $config;
    $authHeader = $request->getHeader('Authorization');
    if ($authHeader) {
        $authHeaders = fdb::convert_to_string($authHeader);
        list($jwt) = sscanf($authHeaders, 'Bearer %s');
        if ($jwt) {
            $secretKey = base64_decode($config['secretkey']);
            $token = JWT::decode($jwt, $secretKey, array('HS512'));
            $idutente = $args['idutente'];
            $f = new FCredenziali();
            $el = $f->load($idutente);
            $response = json_encode($el);
        } else {
            $response = json_encode('HTTP/1.0 400 Bad Request');
        }
    } else {
        $response = json_encode('HTTP/1.0 405 Method Not Allowed');
    }
    return $response;
});

$app->get('/api/profilo/{idutente}', function(ServerRequestInterface $request, ResponseInterface $response, array $args) {
    global $config;
    $authHeader = $request->getHeader('Authorization');
    if ($authHeader) {
        $authHeaders = fdb::convert_to_string($authHeader);
        list($jwt) = sscanf($authHeaders, 'Bearer %s');
        if ($jwt) {
            $secretKey = base64_decode($config['secretkey']);
            $token = JWT::decode($jwt, $secretKey, array('HS512'));
            $idutente = $args['idutente'];
            $f = new FProfilo();
            $profilo = $f->load($idutente);
            $response = json_encode($profilo);
        } else {
            $response = json_encode('HTTP/1.0 400 Bad Request');
        }
    } else {
        $response = json_encode('HTTP/1.0 405 Method Not Allowed');
    }
    return $response;
});

$app->post('/api/profilo/mod', function(ServerRequestInterface $request, ResponseInterface $response) use ($app) {
    global $config;
    $authHeader = $request->getHeader('Authorization');
    if ($authHeader) {
        $authHeaders = fdb::convert_to_string($authHeader);
        list($jwt) = sscanf($authHeaders, 'Bearer %s');
        if ($jwt) {
            $secretKey = base64_decode($config['secretkey']);
            $token = JWT::decode($jwt, $secretKey, array('HS512'));
            $data = $request->getParsedBody();
            $nome = $data['nome'];
            $cognome = $data['cognome'];
            $datadinascita = $data['datadinascita'];
            $indirizzo = $data['indirizzo'];
            $citta = $data['citta'];
            $telefono = $data['telefono'];
            $idutente = $data['idutente'];
            $f = new FProfilo();
            $res = $f->ProfiloUpdate($nome, $cognome,$datadinascita, $citta, $indirizzo, $telefono, $idutente);
            $response = json_encode($res);
        } else {
            $response = json_encode('HTTP/1.0 400 Bad Request');
        }
    } else {
        $response = json_encode('HTTP/1.0 405 Method Not Allowed');
    }
    return $response;
});

$app->post('/api/user/login', function(ServerRequestInterface $request, ResponseInterface $response) use ($app) {
    global $config;
    $data = $request->getParsedBody();
    $email = $data['email_json'];
    $password = $data['password_json'];
    $email_n = json_decode($email);
    $password_n = json_decode($password);
    $freg = new FRegistrazione();
    $res = $freg->login($email_n, $password_n);
    if ($res !== false) {
        //$secretKey = "Ma69r3Ga8A";
        //$issuerClaim = "APACHESERVER";
        //$audienceClaim = "CINEMA";
        $id = $res->idutente;
        $tokenId = base64_encode(random_bytes(32));
        $issuedatClaim = time();
        $notbeforeClaim = $issuedatClaim + 5;
        $expireClaim = $issuedatClaim + 60000;
        $token = array(
            "iss" => $config['issuerclaim'],
            "aud" => $config['audienceclaim'],
            "iat" => $issuedatClaim,
            "nbf" => $notbeforeClaim,
            "exp" => $expireClaim,
            "data" => array(
                "email" => $email),
            "idutente" => $res->idutente);
        $jwt = JWT::encode($token, base64_decode($config['secretkey']), 'HS512');
        $id = $res->idutente;
        $response = json_encode(
                array(
                    "res" => "ok",
                    "message" => "Login eseguito correttamente",
                    "jwt" => $jwt,
                    "email" => $email,
                    "idutente" => $id,
                    "exipireAt" => $expireClaim
        ));
    } else {
        $response = json_encode(
                array(
                    "res" => "ko",
                    "message" => "Credenziali  errate"
        ));
    }
    return $response;
});

$app->post('/api/user/add', function(ServerRequestInterface $request, ResponseInterface $response) use ($app) {
    $data = $request->getParsedBody();
    $password = $data['password'];
    $email = $data['email'];
    //$email_n= json_decode($email);
    //$password_n= json_decode($password);
    $freg = new FRegistrazione();
    $putente = new EUtente();
    $putente->costruttore_registrazione($password, $email);
    $res = $freg->ifexistemail($email);
    if ($res === true) {
        $response = json_encode("email exists");
    } else {
        $freg->store($putente);
        $response = json_encode($putente);
    }
    return $response;
});







