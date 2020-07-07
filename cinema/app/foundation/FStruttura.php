<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\EStruttura.php';

class FStruttura extends  Fdb{

      public function __construct(){
             $this->_table='struttura';
             $this->_key='idfiliale';
             $this->_return_class='EStruttura';
             $this->_connection=USingleton::getInstance("Fdb")->get_connection();}

      public function sale_to_string(array $a){
             $ret='';
             for ($i=0;$i<count($a);$i++){
                 if($i==0) $ret.=$a[$i]->get_nome();
                 else $ret.=','.$a[$i]->get_nome();}
             return $ret;}
      public function nomi_to_array(string $s){
             $nomi=explode(',',$s);
             for ($i=0;$i<count($nomi);$i++){
                $nomi[$i]=ESala::get_sala($nomi[$i]);}
             return $nomi;}

      public function store($struttura){
            if(Fdb::store($struttura)){
                $query='UPDATE struttura SET listasale=\''.$this->sale_to_string($struttura->get_listasale()).'\' WHERE Idfiliale=\''.$struttura->get_idfiliale().'\';';
                return $this->query($query);}
            }

      public function load($key){
            $res=Fdb::load($key);
            $res->set_listasale($this->nomi_to_array($res->listasale));
            unset($res->listasale);
            return $res;
            }
            
      public function update($struttura){
             $res=Fdb::update($struttura);
             $query='UPDATE struttura SET listasale=\''.$this->sale_to_string($struttura->get_listasale()).'\' WHERE idfiliale=\''.$struttura->get_idfiliale().'\';';
             $res=$res&&$this->query($query);
             return $res;}

      public function search($parameters = array()){
            //& for ($j=0; $j<count($parameters)
             $res=Fdb::search($parameters);
             if ($res){for ($i=0; $i<count($res);$i++){
                 $res[$i]->set_listasale($this->nomi_to_array($res[$i]->listasale));
                 unset($res[$i]->listasale);} }
             return $res;}



}
?>
