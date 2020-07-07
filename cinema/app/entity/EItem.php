<?php
require_once ROOT_DIR.'\app\foundation\FItem.php';

class EItem {
      public $nome;  //contiene l'id della proiezione e con un altro # il posto
      public $valore;
      
      public function __construct (){}
      public function costruttore(EProiezione $pr1, EPosto $p1){
             $r=new EItem();
             $x=EItem::crea_nome($pr1,$p1);
             $r->set_nome($x);
             $r->set_valore($r->calcola_valore());
             return $r;}
             
      public function get_nome(){return $this->nome;}
      public function get_valore(){return $this->valore;}
      public function get_proiezione(){
             $temp=$this->get_nome();
             $temp=explode('#',$temp);
             array_pop($temp);array_pop($temp);
             $temp=implode('#',$temp);
             return $temp;}
      public function get_posto(){
             $temp=$this->get_nome();
             $temp=explode('#',$temp);
             $res[1]=array_pop($temp);
             $res[0]=array_pop($temp);
             $res=$res[0].'-'.$res[1];
             return $res;}
      
      public function set_nome(string $valore){$this->nome=$valore;}
      public function set_valore(float $valore){
             $this->valore=$valore;}
      public function calcola_valore(){
             $temp=explode('#',$this->get_nome());
             $date=$temp[0];
             $valore=5.00;
             if ($this->is_festivo($date)){$valore=$valore+2;}
             if ($this->is_prefestivo($date)){$valore=$valore+1;}
             if ($temp[3]=='3'){$valore=$valore+3;}
             return $valore;}
             
      public function is_festivo(string $d){
             $data=new DateTime($d[0].$d[1].'-'.$d[2].$d[3].'-'.$d[4].$d[5]);
             if ($data->format('D')=='Sun'){
                return true;}
             else return false;}
      public function is_prefestivo(string $d){
             $data=new DateTime($d[0].$d[1].'-'.$d[2].$d[3].'-'.$d[4].$d[5]);
             if ($data->format('D')=='Sat'){
                return true;}
             else return false;}
      
      public function crea_nome(EProiezione $pr, EPosto $p){
             $x=$pr->get_id().'#'.$p->get_fila().'#'.$p->get_numero();
             return $x;}
      public function sconta_valore(float $s){
             $w=$this->get_valore();
             $this->set_valore($w-$s);}
}
?>
