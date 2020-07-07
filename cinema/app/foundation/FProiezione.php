<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\EProiezione.php';

class FProiezione extends Fdb{

      public function __construct(){
             $this->_table='proiezione';
             $this->_key='idProiezione';
             $this->_return_class='EProiezione';
             $this->_connection=USingleton::getInstance("Fdb")->get_connection();}
             
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
             
      public function store($proiezione){
            if(Fdb::store($proiezione)){
                $query='UPDATE proiezione SET mappaproiezione=\''.$this->mappa_to_string($proiezione->get_mappa_pro()).'\' WHERE IdProiezione=\''.$proiezione->get_id().'\';';
                $query2='UPDATE proiezione SET film=\''.$proiezione->get_film()->get_titolo().'\' WHERE IdProiezione=\''.$proiezione->get_id().'\';';
                return ($this->query($query)&&$this->query($query2));}
            }
            
      public function load($key){
            $res=Fdb::load($key);
            $res->extract();
            $res->set_film(EFilm::get_film($res->film)); unset ($res->film);
            $m=EMappa::get_mappa($res->get_sala()->get_nome());
            $m->set_schema(FProiezione::string_to_mappa($res->mappaproiezione));
            $res->set_mappa_pro($m); unset ($res->mappaproiezione);
            return $res;
            }
            
      public function update($proiezione){
             $res=Fdb::update($proiezione);
             $query='UPDATE proiezione SET mappaproiezione=\''.$this->mappa_to_string($proiezione->get_mappa_pro()).'\' WHERE IdProiezione=\''.$proiezione->get_id().'\';';
             $query2='UPDATE proiezione SET film=\''.$proiezione->get_film()->get_titolo().'\' WHERE IdProiezione=\''.$proiezione->get_id().'\';';
             $res=$res&&$this->query($query)&&$this->query($query2);
             return $res;}
             
      public function search($parameters = array()){
            //& for ($j=0; $j<count($parameters)
             $res=Fdb::search($parameters);
             if ($res){for ($i=0; $i<count($res);$i++){
                 $res[$i]->extract();
                 $res[$i]->set_film(EFilm::get_film($res[$i]->film)); unset ($res[$i]->film);
                 $m=EMappa::get_mappa($res[$i]->get_sala()->get_nome());
                 $m->set_schema(FProiezione::string_to_mappa($res[$i]->mappaproiezione));
                 $res[$i]->set_mappa_pro($m); unset ($res[$i]->mappaproiezione);} }
             return $res;}
}

?>
