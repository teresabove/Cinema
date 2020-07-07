<?php
require_once ROOT_DIR.'\app\foundation\FPagamento.php';
require_once ROOT_DIR.'\app\entity\EItem.php';
require_once ROOT_DIR.'\app\entity\EProiezione.php';

class EPagamento{

      public $persona;
      public $totale;   //float
      public $idpagamento;  //string //id di ogni pagamento----> 1 biglietto
      public $a_listaitem;  //array di item
      public $pagato;
      
      public function __construct(){}
      public function costruttore(string $p, array $i){
             $x= new EPagamento();
             $x->set_persona($p);
             $x->set_lista_item($i);
             $x->set_totale($x->calcolo_totale());
             $x->set_pagato(false);
             $c=true;
             $conn=new FPagamento();
             while($c){
                       $bytes = random_bytes(3);
                       $bytes=bin2hex($bytes);
                       $cond=array('idpagamento = \''.$bytes.'\'');
                       $cond=$conn->search($cond);
                       if (!($cond>0)){
                          $x->set_id($bytes);
                          $c=false;}
                        }
             return $x;
             }
             
      public function save(){
             $conn=new FPagamento();
             if ($conn->store($this)){}
             else {$conn->update($this);}}
      public function delete(){
             $conn=new FPagamento();
             $conn->delete($this);}
      public function get_pagamento(string $id){
             $conn=new FPagamento();
             return $conn->load($id);}

      public function get_persona(){return $this->persona;}
      public function get_totale(){return $this->totale;}
      public function get_id(){return $this->idpagamento;}
      public function get_lista_item(){return $this->a_listaitem;}
      public function get_pagato(){return $this->pagato;}
      
      public function set_persona(string $valore){$this->persona=$valore;}
      public function set_totale(float $valore){$this->totale=$valore;}
      public function set_id(string $valore){$this->idpagamento=$valore;}
      public function set_lista_item(array $valore){$this->a_listaitem=$valore;}
      public function set_pagato(bool $valore){$this->pagato=$valore;}

      public function calcolo_totale(){
	         $items=$this->get_lista_item();
	         $totale=0;
	         for ($i=0;$i<count($items);$i++){
                 $totale=$totale+$items[$i]->get_valore();}
	         return $totale;
	         }
      public function pagamento(){
             if ($this->get_persona()=='u2'){
                $this->set_pagato(true);}
             else if ($this->get_persona()=='f3'){
                  $this->set_pagato(true);}
             }
      public function crea_biglietto(){
                $x=$this->get_id().bin2hex(random_bytes(1));
                $l=$this->get_lista_item();
                $r='';
                for ($i=0;$i<count($l);$i++){
                    $y=$l[$i]->get_nome();
                    $y=$y1=explode('#',$y);
                    $y1=$y1[0].'#'.$y1[1].'#'.$y1[2].'#'.$y1[3];
                    $pro=EProiezione::get_proiezione($y1);
                    $pro=$pro->get_film()->get_titolo();
                    $y[0]=$y[0][4].$y[0][5].'-'.$y[0][2].$y[0][3].'-'.$y[0][0].$y[0][1] ;
                    $r=$r.'Data '.$y[0].' Ora '.$y[2]."\n".'Film in '.$y[3].'D: '.$pro."\n";
                    $r=$r.'Sala '.$y[1].' Fila '.$y[3].' Posto '.$y[4]."\n".'Prezzo: '.$l[$i]->get_valore()."\n\n";}
                $r=$r.'Totale Pagato: '.$this->get_totale();
                $bigl=new EBiglietto();
                $bigl->costruttore($r,$x);
                return $bigl;}
}

?>
