<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\ECredenziale.php';

class FCredenziali extends Fdb
{
    public function __construct()
    {
        $this->_table='credenziale';
        $this->_key='numerocarta';
        $this->_return_class='ECredenziale';
        $this->_connection=USingleton::getInstance("Fdb")->get_connection();
    }




}