<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\EMappa.php';

class FMappa extends Fdb{

      public function __construct(){
             $this->_table='mappa';
             $this->_key='nomeschema';
             $this->_return_class='EMappa';
             $this->_connection=USingleton::getInstance("Fdb")->get_connection();}
 /*            
      public function mappa_to_string(EMappa $mappa){
             $res='';
             $mappa=$mappa->get_schema();
             foreach ($mappa as $v){
                     foreach ($v as $v1){
                            $res=$res.$v1->get_fila().'-'.$v1->get_numero().'-'.$v1->get_occupato().'#';}}
             return $res;}
      public function string_to_mappa(string $mappa){
             $mappa=explode('#',$mappa);
             array_pop($mappa);
             $res=array();
             foreach ($mappa as $v){
                     $v=explode('-',$v);
                     $p=new EPosto();
                     $p->costruttore($v[0],$v[1],$v[2]);
                     $res[$v[0]][$v[1]]=$p;}
             return $res;}
   */          
      public function store($mappa){
            if(Fdb::store($mappa)){
                $query='UPDATE mappa SET modello=\''.$this->mappa_to_string($mappa).'\' WHERE nomeschema=\''.$mappa->get_nome_schema().'\';';
                return ($this->query($query));}
            }

      public function load($key){
            $query= 'SELECT * FROM '.$this->_table.' WHERE nomeschema ='.'\''.$key.'\'';
            $this->query($query);
            $mappa=$this->getObject();
            $np=$mappa->numero_posti;
            $nf=$mappa->numero_file;
            $ns=$mappa->nomeschema;
            $mappa->costruttore($np,$nf,$ns);
            return $mappa;
            }

      public function update($mappa){
             $res=Fdb::update($mappa);
             $res=$res&&$this->query($query);
             return $res;}

      public function search($parameters = array()){
             $res=Fdb::search($parameters);
             if ($res){for ($i=0; $i<count($res);$i++){
                 $res[$i]->set_schema(FMappa::string_to_mappa($res[$i]->modello)); unset ($res[$i]->modello);} }
             return $res;}
}

?>
