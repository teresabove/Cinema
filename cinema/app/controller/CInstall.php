<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/api/install/verify', function(ServerRequestInterface $request, ResponseInterface $response) {
     //$install = false;
    if (file_exists('config.php')) {
        $response = json_encode('exists');
    } else {
        $response = json_encode('update');
    }
    return $response;
});

$app->post('/api/install', function(ServerRequestInterface $request, ResponseInterface $response) use ($app) {   
    $data = $request->getParsedBody();
    if (version_compare(PHP_VERSION, '7.0.0', '<')){
        $res="Si richiede una versione di PHP maggiore di 7, altrimenti non si può proseguire con l'installazione";
    } else {
    $admin_json = $data['admin_json'];
    $pwd_json = $data['pwd_json'];
    $database_json = $data['db_json'];
    $admin = json_decode($admin_json);
    $pwd = json_decode($pwd_json);
    $database = json_decode($database_json);
    $host = 'localhost';
    $conn = new PDO("mysql:host=$host;", $admin, $pwd);
    $conn->beginTransaction();
    $query = 'DROP DATABASE IF EXISTS ' . $database . ';
      CREATE DATABASE ' . $database . ' ;
      USE ' . $database . ';';
    //$query = $query . file_get_contents('tabelle.sql');
    $conn->exec($query);
    $query1 = $query . file_get_contents('cinemadb.sql');
    $conn->exec($query1);
    $conn->commit();
    $file = fopen('config.php', 'w');
    $script = '<?php global $config; $config[' . '\'' . 'mysql' . '\'' . '][' . '\'' . 'user' . '\'' . '] = ' . '\''.$admin .'\''. '; $config[' . '\'' . 'mysql' . '\'' . '][' . '\'' . 'password' . '\'' . '] = ' .'\''. $pwd .'\''. '; $config[' . '\'' . 'mysql' . '\'' . '][' . '\'' . 'host' . '\'' . '] = ' .'\''. 'localhost' .'\''. '; $config[' . '\'' . 'mysql' . '\'' . '][' . '\'' . 'db' . '\'' . '] = ' . '\''.$database.'\'' . '; $config[' . '\'' . 'secretkey' . '\'' . '] = base64_encode("Ma69r3Ga8A"); $config[' . '\'' . 'issuerclaim' . '\'' . ']= "APACHESERVER"; $config[' . '\'' . 'audienceclaim' . '\'' . ']= "CINEMA"; ?>';
    fwrite($file, $script);
    fclose($file);
    $res="Installazione avvenuta con successo";
    }
    $response = json_encode($res);
    return $response;
});

