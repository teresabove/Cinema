<?php
require_once ROOT_DIR.'\app\foundation\FProiezione.php';
require_once ROOT_DIR.'\app\entity\EFilm.php';
require_once ROOT_DIR.'\app\entity\ESala.php';
require_once ROOT_DIR.'\app\entity\EMappa.php';

class EProiezione{
      public $film;
      public $sala;
      public $giorno;        //da inserire in formato gg-mm-aaaa
      public $orario;
      public $mappaproiezione;  //oggetto mappa;
      public $tipo;
      public $idproiezione;     //l'id contiene data,nome sala, ora e tipo separati da #
      
      public function __construct (){}
      public function costruttore (EFilm $f, ESala $s, string $g,string $o, EMappa $m, string $t, int $id){
             $this->set_film($f);
             $this->set_sala($s);
             $this->set_giorno($g);
             $this->set_orario($o);
             $this->set_mappa_pro($m);
             $this->set_tipo($t);
             $this->set_id($id);}
             
      public function save(){
             $conn=new FProiezione();
             if ($conn->store($this)){}
             else {$conn->update($this);}}
      public function delete(){
             $conn=new FProiezione();
             $conn->delete($this);}
      public function get_proiezione(string $id){
             $conn=new FProiezione();
             return $conn->load($id);}
             
      public function get_film(){return $this->a_film;}
      public function get_sala(){return $this->a_sala;}
      public function get_giorno(){return $this->a_giorno;}
      public function get_orario(){return $this->a_orario;}
      public function get_mappa_pro(){return $this->a_mappaproiezione;}
      public function get_tipo(){return $this->tipo;}
      public function get_id(){return $this->idProiezione;}

      public function set_film(EFilm $valore){$this->film=$valore;}
      public function set_sala(ESala $valore){$this->sala=$valore;}
      public function set_giorno(string $valore){$this->giorno=$valore;}
      public function set_orario(string $valore){$this->orario=$valore;}
     /* public function set_orario(string $valore){
             $x=array(':',',','.');
             $a=str_replace($x,' ',$valore);
             $a=explode(' ',$a);
             if($a[0]>=0&&$a[0]<=23&&$a[1]>=0&&$a[1]<=59){
                 $this->a_orario=$a[0].'.'.$a[1];}}*/
      public function set_mappa_pro(EMappa $valore){$this->mappaproiezione=$valore;}
     // public function set_mappa_pro(EMappa $valore){$this->a_mappaproiezione=$valore;}
      public function set_tipo(string $valore){$this->tipo=$valore;}
      public function set_id(int $id){
           //  $x=explode('-',$this->get_giorno());
            // $i=$x[2][2].$x[2][3].$x[1].$x[0].'#'.$this->get_sala()->get_nome().'#'.$this->get_orario().'#'.$this->get_tipo();
             $this->idproiezione=$id;}
      public function extract(){
             $s=$this->get_id();
             $a=explode('#',$s);
             $this->set_giorno($a[0][4].$a[0][5].'-'.$a[0][2].$a[0][3].'-'.$a[0][0].$a[0][1]);
             $this->set_sala(ESala::get_sala($a[1]));
             $this->set_orario($a[2]);
             $this->set_tipo($a[3]);}

}
?>
