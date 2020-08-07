<?php
class EPosto{
      public $fila;
      public $numero;
      public $occupato;
      public $proiezione;

      public function __construct(){}
      public function costruttore(string $f, int $nr, bool $o, string $p){
      $this->set_fila($f);
      $this->set_numero($nr);
      $this->set_occupato(false);
      $this->set_proiezione($p);
      }
      
      
      public function get_fila(){return $this->fila;}
      public function get_numero(){return $this->numero;}
      public function get_occupato(){return $this->occupato;}
      public function get_proiezione(){return $this->proiezione;} 
      
      public function set_fila(string $valore){$this->fila=$valore;}
      public function set_numero(string $valore){$this->numero=$valore;}
      public function set_occupato(bool $valore){$this->occupato=$valore;}
      public function set_proiezione(string $valore){$this->proiezione=$valore;}
}
?>
