<?php
require_once 'app\utility\USingleton.php';
require_once 'app\foundation\fdb.php';
require_once 'app\entity\ESala.php';

class FSala extends fdb{

      public function __construct(){
             $this->_table='sala';
             $this->_key='nomesala';
             $this->_return_class='ESala';
             $this->_connection=USingleton::getInstance("Fdb")->get_connection();}
             
             public function load($nomesala){
                 $res=fdb::load($nomesala);
                 return $res;
             }

}

?>
