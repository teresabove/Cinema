<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ROOT_DIR . '\app\utility\USingleton.php';
require_once ROOT_DIR . '\app\foundation\Fdb.php';
require_once ROOT_DIR . '\app\entity\EPosto.php';

class FPosto extends fdb {

    public function __construct() {
        $this->_table = 'posto';
        $this->_key = 'idposto';
        $this->_return_class = 'EPosto';
        $this->_connection = USingleton::getInstance("Fdb")->get_connection();
    }

     public function store($object) {
     if ($object->occupato == FALSE) {
      $object->occupato = true;
      $res = Fdb::store($object);
      } else {
      $res = "posto già occupato";
      }
      return $res;
      } 

    public function load($key){
        $query = "SELECT * FROM " . $this->_table . "  WHERE proiezione = ". $key . " AND occupato = true";
        $this->query($query);
        return $this->getObjectArray();
    }

}
