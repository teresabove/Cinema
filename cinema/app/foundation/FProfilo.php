<?php

require_once 'app\utility\USingleton.php';
require_once 'app\foundation\Fdb.php';
require_once 'app\entity\EProfilo.php';
require_once 'app\foundation\FRegistrazione.php';

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
    
    public function ProfiloUpdate(string $nome, string $cognome, string $datadinascita, string $citta, string $indirizzo, string $telefono, int $idutente){
        $query ="UPDATE ".$this->_table . " SET nome = ".'\''. $nome .'\'' . " , cognome= ".'\''. $cognome. '\''. ", datadinascita=" .'\''.$datadinascita.'\''. " , indirizzo =". '\''.$indirizzo .'\''. ", citta=". '\''. $citta .'\''. " , telefono=" .'\''. $telefono.'\'' . " WHERE idutente=" .$idutente;
        $res =$this->query($query);
        if ($res){
            $query1 = "UPDATE ". $this->_table . " SET configurato = true";
            $res1=$this->query($query1);
            return $res1;
        }
        return $res1;
    }

    public function load($key) {
        $res = Fdb::load($key);
        //$res->set_listasconti($this->convert_to_array($res->a_listasconti));
        //unset($res->a_listasconti);
        return $res;
    }


}

?>