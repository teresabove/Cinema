<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\EItem.php';

class FItem extends Fdb{

    public function __construct()
    {
        $this->_table='item';
        $this->_key='nome';
        $this->_return_class='EItem';
        $this->_connection=USingleton::getInstance("Fdb")->get_connection();
    }
}
?>

