<?php
require_once 'app\foundation\FMappa.php';
require_once 'app\entity\EPosto.php';

class EMappa{
      public $numero_file;
      public $numero_posti;
      public $nomeschema;
      public $matrice;

      public function __construct(){}
      public function costruttore(int $f, int $p, string $n){      //la mappa la deve prendere da file in base al nome dello schema
             $this->set_numero_file($f);
             $this->set_numero_posti($p);
             $this->set_nome_schema($n);  
             $this->set_schema($f,$p);}
              
      public function save(){
             $conn=new FMappa();
             if ($conn->store($this)){}
             else {$conn->update($this);}}
      public function delete(){
             $conn=new FMappa();
             $conn->delete($this);}
      public function get_mappa(string $id){
             $conn=new FMappa();
             return $conn->load($id);}

      public function get_numero_file(){return $this->numero_file;}
      public function get_numero_posti(){return $this->numero_posti;}
      public function get_schema(){return $this->matrice;}
      public function get_nome_schema(){return $this->nomeschema;}

      public function set_numero_file(int $valore){$this->numero_file=$valore;}
      public function set_numero_posti(int $valore){$this->numero_posti=$valore;}
     // public function set_schema(array $valore){$this->matrice=$valore;}
      public function set_schema(int $f, int $p){
              for ($i=1; $i<=$p; $i++){
                  for ($j=1; $j<=$f; $j++){
                $posto= new EPosto();
                $posto->costruttore($i, $j,0);
                $this->matrice[]=$posto;
              }
              }
      }
      public function set_nome_schema(string $valore){$this->nomeschema=$valore;}

      public function delete_posti(string $f, int $s_p, int $e_p){
             if (array_key_exists($f,$this->matrice)){
                if (array_key_exists($s_p,$this->matrice[$f])){               //se non esistono pi? il numero di posto iniziale o finale non elimina niente
                   if (array_key_exists($e_p,$this->matrice[$f])){
                      array_splice($this->matrice[$f],$s_p-1,$e_p-$s_p+1);}
                   }
                }
             }

      }

?>
