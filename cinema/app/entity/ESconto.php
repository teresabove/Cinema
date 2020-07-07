<?php
require_once ROOT_DIR.'\app\foundation\FSconto.php';

class ESconto{
  public $idsconto;
  public $baseapplicazione;
  public $descrizione;
 
  public function __construct(){}
  public function costruttore(int $id, float $val, string $descrizione){
	  $this->idsconto=$id;
	  $this->base_applicazione=$val;
	  $this->descrizione=$descrizione;
  }
  public function get_idsconto(){return $this->idssconto;}
  public function set_idsconto(int $val){$this->idsconto=$val;}
  public function get_descrizione(){return $this->descrizione;}
  public function set_descrizione(string $descrizione){$this->descrizione=$descrizione;}
  public function get_valore(){return $this->baseapplicazione;}
  public function set_valore(float $valore){$this->baseapplicazione=$valore;}
  
  public function calcola_sconto(float $val1, float $val2){
	  if ($val1 != 0 && $val2 !=0){
		  
	   
  } else {
	  print("Non si possono applicare sconti su valori nulli");
}
  }
}
  
?>