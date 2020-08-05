<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Firebase\JWT\JWT;

require_once ROOT_DIR.'\app\foundation\FFilm.php';
require_once ROOT_DIR.'\app\foundation\FRegistrazione.php';
require_once ROOT_DIR.'\app\entity\EUtente.php';
require_once ROOT_DIR.'\app\entity\EProfilo.php';
require_once ROOT_DIR.'\app\foundation\FCredenziali.php';

$app->get('/api/profilo/credenziale/{idutente}',function(ServerRequestInterface $request, ResponseInterface $response,array $args){
    $idutente=$args['idutente'];
    
    $f= new FCredenziali();
    $el=$f->load($idutente);
    $response=json_encode($el);
    return $response;
});

$app->get('/api/profilo/{email}',function(ServerRequestInterface $request, ResponseInterface $response,array $args){
    $email=$args['email'];
    $f= new FProfilo();
    $profilo=$f->loadbyemail($email);
    if (empty($profilo)){
       $response=json_encode('empty'); 
    } else {
    $response=json_encode($profilo);}
    return $response;
});

$app->post('/api/user/login', function(ServerRequestInterface $request, ResponseInterface $response) use ($app){
   $data= $request->getParsedBody();
   $email= $data['email_json'];
   $password=$data['password_json'];
   $email_n= json_decode($email);
   $password_n= json_decode($password);
   $freg= new FRegistrazione();   
   $res = $freg->login($email_n, $password_n);
   if ( $res !== null){
    $secretKey = "Ma69r3Ga8A";
    $issuerClaim = "APACHESERVER";
    $audienceClaim = "CINEMA";
    $issuedatClaim = time();
    $notbeforeClaim = $issuedatClaim + 10;
    $expireClaim = $issuedatClaim + 60000;
    $token = array(
        "iss" => $issuerClaim,
        "aud" => $audienceClaim,
        "iat" => $issuedatClaim,
        "nbf" => $notbeforeClaim,
        "exp" => $expireClaim,
        "data" => array(
            "email" => $email,
            "password" => $password),
            "idregistrazione" => $res);
    $jwt = JWT::encode($token, $secretKey);
    $response= json_encode(
            array(
                "res" => "ok",
                "message" => "Login eseguito correttamente",
                "jwt" => $jwt,
                "email" => $email,
                "exipireAt" => $expireClaim
    ));
   } else {
       $response= json_encode(
            array(
                "res" => "ko",
                "message" => "Credenziali  errate"
    ));}
   return $response;
   });
   
   $app->post('/api/user/add',function(ServerRequestInterface $request, ResponseInterface $response) use ($app) {
    $data = $request->getParsedBody();
    $password=$data['password'];
    $email=$data['email'];
    $freg= new FRegistrazione();
    $putente= new EUtente();
    $putente->costruttore_registrazione($password,$email);
    $freg->store($putente);    
    $response=json_encode($putente);
    return $response;
     
});







