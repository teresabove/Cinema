<?php
class EPosto{
      public $fila;
      public $numero;
      public $occupato;

      public function __construct(){}
      public function costruttore(string $f, int $nr, int $o){
      $this->set_fila($f);
      $this->set_numero($nr);
      $this->set_occupato($o);}
      
      public function get_fila(){return $this->fila;}
      public function get_numero(){return $this->numero;}
      public function get_occupato(){return $this->occupato;}
      
      public function set_fila(string $valore){$this->fila=$valore;}
      public function set_numero(int $valore){$this->numero=$valore;}
      public function set_occupato(int $valore){$this->occupato=$valore;}
}
?>
