<?php
require_once ROOT_DIR.'\app\foundation\Fbiglietto.php';

class EBiglietto{
      public $riepilogo;
      public $idbiglietto;
      
      public function __construct(){}

      public function costruttore(string $text, string $idb){
             $this->riepilogo=$text;
             $this->idbiglietto=$idb;}
        
      public function save(){
             $conn=new FBiglietto();
             if ($conn->store($this)){}
             else {$conn->update($this);}}
      public function delete(){
             $conn=new FBiglietto();
             $conn->delete($this);}
      public function get_biglietto(string $id){
             $conn=new FBiglietto();
             return $conn->load($id);}
             
      public function get_riepilogo(){return $this->riepilogo;}
      public function get_idbiglietto(){return $this->idbiglietto;}
      public function set_riepilogo(string $valore){$this->riepilogo=$valore;}
      public function set_idbiglietto(string $valore){$this->idbiglietto=$valore;}
      
      public function stampa_biglietto(){
             $bigl='Codice Biglietto: '.$this->get_idbiglietto()."\n\n".$this->get_riepilogo()."\n\n";
             return $bigl;}
      }

?>
