<?php

require_once ROOT_DIR . '\app\utility\USingleton.php';
require_once ROOT_DIR . '\app\foundation\Fdb.php';
require_once ROOT_DIR . '\app\entity\EProfilo.php';
require_once ROOT_DIR . '\app\foundation\FRegistrazione.php';

class FProfilo extends Fdb {

    public function __construct() {
        $this->_table = 'profilo';
        $this->_key = 'idutente';
        $this->_return_class = 'EProfilo';
        $this->_connection = USingleton::getInstance("Fdb")->get_connection();
    }

    public function convert_to_string(array $a) {
        $ret = '';
        for ($i = 0; $i < count($a); $i++) {
            if ($i == 0)
                $ret .= $a[$i];
            else
                $ret .= ',' . $a[$i];
        }
        return $ret;
    }

    public function convert_to_array(string $s) {
        return explode(',', $s);
    }

    public function store($object) {
        $res = Fdb::store($object);
        return $res;
    }

    public function load($key) {
        $res = Fdb::load($key);
        $res->set_listasconti($this->convert_to_array($res->listasconti));
        unset($res->listasconti);
        return $res;
    }

    public function loadbyemail($email) {
        $f = new FRegistrazione();
        $res1 = $f->load($email);
        $id = $res1->Idregistrazione;
        $query = 'SELECT * FROM profilo WHERE IdRegistrazione=' . '\'' . $id . '\'';
        $res2 = $this->_connection->query($query);
        $nr=$res2->num_rows;
        if ($nr>0){
        $profilo=$res2->fetch_object('EProfilo');}
        return $profilo;
    }

}

?>