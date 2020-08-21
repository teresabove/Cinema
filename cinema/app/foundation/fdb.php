<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class fdb {

    public $_connection;
    public $_result;
    public $_table;
    public $_key;
    public $_return_class;
    public $_autoinc = false;

    public function __construct() {
        global $config;
        //$this->_connection= new mysqli($host, $username, $passwd, $dbname);
        $this->_connection = new mysqli('localhost', 'root', '','cinemadb');
        if ($this->_connection->connect_errno) {
            die('Impossibile connettersi al database: ' . $this->_connection->error);
        }
        $this->_connection->set_charset('utf8');
    }

    public function get_connection() {
        return $this->_connection;
    }

    public function query($query) {
        if (isset($this->_connection)) {
            $this->_result = $this->_connection->query($query);
            if (!$this->_result)
                return false;
            else
                return true;
        } else
            return false;
    }

    public function getArrayAss() {
        if ($this->_result != false) {
            $numero_righe = $this->_result->num_rows;
            if ($numero_righe > 0) {
                $return = array();
                while ($row = $this->_result->fetch_assoc()) {
                    $return[] = $row;
                }
                $this->_result = false;
            }
        }
        return false;
    }

    public function getObject() {
        if ($this->_result != false) {
            $numero_righe = $this->_result->num_rows;
            //debug('Numero risultati:'. $numero_righe);
            if ($numero_righe > 0) {
                $row = $this->_result->fetch_object($this->_return_class);
                $this->_result = false;
                return $row;
            }
        } else
            return false;
    }

    public function getObjectArray() {
        if ($this->_result != false) {
            $numero_righe = $this->_result->num_rows;
            if ($numero_righe > 0) {
                $return = array();
                while ($row = $this->_result->fetch_object($this->_return_class)) {
                    $return[] = $row;
                }
                $this->_result = false;
                return $return;
            }
        } else
            return false;
    }

    public function close() {
        $this->_connection->close();
        unset($this->_connection);
        debug('Connessione al db chiusa');
    }

    public function store($object) {
        $i = 0;
        $values = $fields = '';
        foreach ($object as $key => $value) {
            if (!($this->_autoinc && $key == $this->_key) && substr($key, 0, 2) != 'a_') {
                if ($i == 0) {
                    $fields .= $key;
                    $values .= '\'' . $value . '\'';
                } else {
                    $fields .= ',' . $key;
                    $values .= ',\'' . $value . '\'';
                }
                $i++;
            }
        }
        $query = 'INSERT INTO ' . $this->_table . ' (' . $fields . ') VALUES (' . $values . ')';
        $return = $this->query($query);
        return $return
        ;
    }

    public function load($key) {
        $query = 'SELECT * FROM ' . $this->_table . ' WHERE ' . $this->_key . '=\'' . $key . '\'';
        $this->query($query);
        return $this->getObject();
    }
    
    public function loadarray($key) {
        $query = 'SELECT * FROM ' . $this->_table . ' WHERE ' . $this->_key . '=\'' . $key . '\'';
        $this->query($query);
        return $this->getObjectArray();
    }

    public function loadall() {
        $query = 'SELECT * FROM ' . $this->_table;
        $this->query($query);
        return $this->getObjectArray();
    }

    public function delete(& $object) {
        $arrayObj = get_object_vars($object);
        $query = 'DELETE FROM ' . $this->_table . ' WHERE ' . $this->_key . ' = \'' . $arrayObj[$this->_key] . '\'';
        unset($object);
        return $this->query($query);
    }

    public function update($object) {
        $i = 0;
        $fields = '';
        foreach ($object as $key => $value) {
            if (!($this->_autoinc && $key == $this->_key) && substr($key, 0, 2) != 'a_') {
                if ($i == 0) {
                    $fields .= '`' . $key . '` = \'' . $value . '\'';
                } else {
                    $fields .= ', `' . $key . '` = \'' . $value . '\'';
                }
                $i++;
            }
        }
        $arrayObj = get_object_vars($object);
        $query = 'UPDATE ' . $this->_table . ' SET ' . $fields . ' WHERE ' . $this->_key . ' = \'' . $arrayObj[$this->_key] . '\'';
        return $this->query($query);
    }

    public function search($parameters = array()/* , $ordinamento */) {
        $filtro = '';
        for ($i = 0; $i < count($parameters); $i++) {
            if ($i > 0) {
                $filtro .= ' AND' . $parameters[$i];
            } else {
                $filtro .= ' ' . $parameters[$i];
            }
            $query = 'SELECT * ' . 'FROM ' . $this->_table . ' ';

            if ($filtro != '')
                $query .= 'WHERE ' . $filtro . ' ';
            debug($query);
            /* if ($ordinamento != '')
              $query .= 'ORDER BY ' . $ordinamento . ' ';
              if ($limit != '')
              $query .= 'LIMIT ' . $limit . ' '; */
            $this->query($query);

            return $this->getObjectArray();
        }
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

   

}
