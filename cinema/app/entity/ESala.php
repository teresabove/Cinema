<?php
require_once 'app\foundation\FSala.php';

class ESala {
      public $nomesala;
      public $numeroposti;
      public $nomeschema;
      public $numerofile;
      
      public function __construct (){}
      public function costruttore (string $ns, int $nr, string $nm, int $nf){
             $this->set_nome($ns);
             $this->set_nr_posti($nr);
             $this->set_nomeschema($nm);
             $this->set_numerofile($nf);
      }
             
      public function save(){
             $conn=new FSala();
             $cerca=array('nomesala = \''.$this->get_nome().'\'');
             $res=$conn->search($cerca);
             if ($conn->store($this)){}
             else {$conn->update($this);}}
      public function delete(){
             $conn=new FSala();
             $conn->delete($this);}
      public function get_sala(string $nomesala){
             $conn=new FSala();
             return $conn->load($nomesala);}
             
      public function get_nome(){return $this->nomesala;}
      public function get_nr_posti(){return $this->numeroposti;}
      public function set_nome(string $valore){$this->nomesala=$valore;}
      public function set_nr_posti(int $valore){$this->numeroposti=$valore;}
      public function get_nomeschema(){return $this->nomeschema;}
      public function set_nomeschema(string $valore){$this->nomeschema=$valore;}
      public function get_numerofile(){return $this->numerofile;}
      public function set_numerofile(int $nf){$this->numerofile=$nf;}
}

?>
