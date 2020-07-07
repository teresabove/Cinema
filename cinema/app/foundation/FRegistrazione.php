<?php

require_once ROOT_DIR . '\app\utility\USingleton.php';
require_once ROOT_DIR . '\app\foundation\fdb.php';
require_once ROOT_DIR . '\app\entity\EUtente.php';
require_once ROOT_DIR . '\app\foundation\FProfilo.php';
use \Firebase\JWT\JWT;

class FRegistrazione extends fdb {
    public function __construct() {
        $this->_table = 'registrazione';
        $this->_key = 'email';
        $this->_autoinc = true;
        $this->_return_class = 'EUtente';
        $this->_connection = USingleton::getInstance("fdb")->get_connection();
    }

    //AD OGNI NUOVO UTENTE REGISTRATO, COLLEGO UN PROFILO VUOTO, CHE SUCCESSIVAMENTE L'UTENTE 
    // RIEMPIRA' DA FORM. AL MONENTO DELLA REG., L'UTENTE DEVE INSERIRE MAIL E PWD 
    public function store($eutente) {
        $email = $eutente->get_email();
        $query = 'INSERT INTO registrazione (password,email) VALUES (' . '\'' . $eutente->get_password() . '\'' . ',' . '\'' . $eutente->get_email() . '\'' . ')';
        $this->query($query);
        $res = $this->load($email);
        $id = $res->Idregistrazione;
        $profilo = new EProfilo();
        $profilo->set_idregistrazione($id);
        $f = new FProfilo();
        $f->store($profilo);
    }

    public function load($email) {
        $res = fdb::load($email);
        return $res;
    }

    //VERIFICO LA PRESENZA DI UN ACCOUNT UTENTE CON I PARAMTRI EMAIL E PWD
    //E RESTITUISCE UN TOKEN 
    public function login($email, $password) {
        $islogged= false;
        $query = 'SELECT * FROM registrazione WHERE email = ' . '\'' . $email . '\'' . ' AND password = ' . '\'' . $password . '\'';
        $res = $this->_connection->query($query);
        if ($res->num_rows == 1) {
    $islogged = true;} else {$islogged = false;}
        return $islogged;
    } 
    }
    
   





     