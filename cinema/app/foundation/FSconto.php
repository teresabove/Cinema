<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\ESconto.php';

class FSconto extends Fdb{
    public function __construct()
    {
        $this->_table = 'sconto';
        $this->_key = 'idsconto';
        $this->_return_class = 'ESconto';
        $this->_connection = USingleton::getInstance('Fdb')->get_connection();
    }
    
    public function loadall(){
        $res= Fdb::loadall();
        return $res;
    }

}