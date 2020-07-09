<?php

require_once ROOT_DIR . '\app\utility\USingleton.php';
require_once ROOT_DIR . '\app\foundation\fdb.php';
require_once ROOT_DIR . '\app\entity\EFilm.php';

class FFilm extends fdb {

    public function __construct() {

        $this->_table = 'film';
        $this->_key = 'titolo';
        $this->_return_class = 'EFilm';
        $this->_connection = USingleton::getInstance("fdb")->get_connection();
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

    public function store($film) {
        if (Fdb::store($film)) {
            $query = 'UPDATE film SET a_generi=\'' . $this->convert_to_string($film->get_generi()) . '\', a_cast=\'' . $this->convert_to_string($film->get_cast()) . '\' WHERE titolo=\'' . $film->get_titolo() . '\';';
            //debug($this->query($query));
            return $this->query($query);
        }
    }

    public function load($key) {
        $res = fdb::load($key);
        return $res;
    }

    public function loadallfilm() {   //ok aggiustare gli array
        $res = Fdb::loadall();
        //$res->set_generi($this->convert_to_array($res->a_generi));
        //$res->set_cast($this->convert_to_array($res->a_cast));
        return $res;
    }

    public function update($film) {
        $res = Fdb::update($film);
        $query = 'UPDATE film SET generi=\'' . $this->convert_to_string($film->get_generi()) . '\', cast=\'' . $this->convert_to_string($film->get_cast()) . '\' WHERE titolo=\'' . $film->get_titolo() . '\';';
        $res = $res && $this->query($query);
        return $res;
    }

    public function search($parameters = array()) {
        //& for ($j=0; $j<count($parameters)
        $res = Fdb::search($parameters);
        if ($res) {
            for ($i = 0; $i < count($res); $i++) {
                $res[$i]->set_generi($this->convert_to_array($res[$i]->generi));
                $res[$i]->set_cast($this->convert_to_array($res[$i]->cast));
                unset($res[$i]->generi);
                unset($res[$i]->cast);
            }
        }
        return $res;
    }
    
    public function searchbygenere ($tipo,$genere){
        $query= 'SELECT * from '.$this->_table.' WHERE FIND_IN_SET ('.'\''.$tipo.'\''.','.$genere.')';
        $res=$this->query($query);
        return $this->getObjectArray();
    }

}

?>
