<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\EBiglietto.php';

class Fbiglietto extends Fdb           //necessaria al db l'implementazione almeno di pagamento
{
    public function __construct()
    {
        $this->_table = 'biglietto';
        $this->_key = 'idbiglietto';
        $this->_return_class = 'EBiglietto';
        $this->_connection = USingleton::getInstance('Fdb')->get_connection();
    }
    
    public function store($object) {
        $res = Fdb::store($object);
        return $res;
    }
    
    public function loadbyId($key){
        $query = "SELECT * FROM " . $this->_table . " WHERE idutente = ". $key;
        $this->query($query);
        return $this->getObjectArray();
    }

}
