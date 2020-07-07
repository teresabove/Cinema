<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\ESala.php';

class FSala extends Fdb{

      public function __construct(){
             $this->_table='sala';
             $this->_key='nomesala';
             $this->_return_class='ESala';
             $this->_connection=USingleton::getInstance("Fdb")->get_connection();}

}
?>
