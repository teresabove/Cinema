<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'C:\xampp\htdocs\progetto\cinema\app\config\config.php';
require ROOT_DIR . '\vendor\autoload.php';
require_once ROOT_DIR . '\app\foundation\FFilm.php';
require_once ROOT_DIR. '\app\entity\EFilm.php';
require_once ROOT_DIR.'\app\entity\EMappa.php';
require_once ROOT_DIR.'\app\foundation\FMappa.php';
require_once ROOT_DIR.'\app\entity\EProiezione.php';
require_once ROOT_DIR.'\app\foundation\FSala.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //var_dump($conn);
}
$numero_posti=2;
$numero_file=3;
$mappa= new EMappa();
$mappa->costruttore($numero_posti, $numero_file,'schema_sala_blu');
print_r($mappa);




