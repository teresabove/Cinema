<?php
require_once ROOT_DIR.'\app\utility\USingleton.php';
require_once ROOT_DIR.'\app\foundation\Fdb.php';
require_once ROOT_DIR.'\app\entity\EPagamento.php';

class FPagamento extends Fdb{

      public function __construct()
      {
          $this->_table='pagamento';
          $this->_key='idpagamento';
          $this->_return_class='EPagamento';
          $this->_connection=USingleton::getInstance("Fdb")->get_connection();
      }
    
      public function lista_to_string(array $lista){
             $res='';
             for ($i=0;$i<count($lista);$i++){
                 $res=$res.$lista[$i]->get_nome().'#'.$lista[$i]->get_valore().'-';}
             return $res;}
      public function string_to_lista(string $lista){
             $lista=explode('-',$lista);
             array_pop($lista);
             $res=array();
             for ($i=0;$i<count($lista);$i++){
                 $temp=explode('#',$lista[$i]);
                 $item=new EItem();
                 $item->set_valore(array_pop($temp));
                 $item->set_nome(implode('#',$temp));
                 $res[]=$item;
                 }
             return $res;
             }

      public function store($object){
             Fdb::store($object);
             $query='UPDATE pagamento SET listaitem=\''.$this->lista_to_string($object->get_lista_item()).'\' WHERE idpagamento=\''.$object->get_id().'\';';
             return ($this->query($query));
             }
             
      public function load($key){
             $res=Fdb::load($key);
             if ($res){$res->set_lista_item(FPagamento::string_to_lista($res->listaitem)); unset ($res->listaitem);
             return $res;}}
             
      public function update($object){
             $res=Fdb::update($object);
             $query='UPDATE pagamento SET listaitem=\''.$this->lista_to_string($object->get_lista_item()).'\' WHERE idpagamento=\''.$object->get_id().'\';';
             $res=$res&&$this->query($query);
             return $res;}
             
      public function search($parameters = array()){
            //& for ($j=0; $j<count($parameters)
             $res=Fdb::search($parameters);
             if ($res){for ($i=0; $i<count($res);$i++){
                 $res[$i]->set_lista_item(FPagamento::string_to_lista($res[$i]->listaitem)); unset ($res[i]->listaitem);} }
             return $res;}


}





?>
