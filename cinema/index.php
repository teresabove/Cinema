<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;


if(file_exists('config.php')){
  include 'config.php';
}
//require_once 'config.php';
require 'vendor\autoload.php';

$app = new \Slim\App;

require_once 'app\controller\CUser.php';
require_once 'app\controller\CFilm.php';
require_once 'app\controller\CMappa.php';
require_once 'app\controller\CProiezioni.php';
require_once 'app\controller\CSala.php';
require_once 'app\controller\CBiglietto.php';
require_once 'app\controller\CPosto.php';
require_once 'app\controller\CSconto.php';
require_once 'app\controller\CInstall.php';

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer('view/');

$app->get('/', function (Request $request, Response $response) {
    $response = $this->view->render($response, "index.html");
    return $response;
});



$app->run();

