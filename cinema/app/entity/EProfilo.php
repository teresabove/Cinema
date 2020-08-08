<?php
require_once ROOT_DIR.'\app\foundation\FProfilo.php';
require_once ROOT_DIR.'\app\entity\ECredenziale.php';
require_once ROOT_DIR.'\app\entity\ESconto.php';

class EProfilo{
                public $nome;
		public $cognome;
		public $datadinascita;
		public $indirizzo;
		public $citta;
		public $telefono;
		public $a_listasconti;
                public $idutente;
                

public function __construct(){}
public function costruttore2 (ECredenziale $CC, array $Sconti){
	$this->set_cartacredito($CC);
	$this->a_listasconti=$Sconti;}
public function get_nome(){return $this->nome;}
public function set_nome(string $valore){$this->nome=$valore;}
public function get_cognome() {return $this->cognome;}
public function set_cognome(string $valore){$this->cognome=$valore;}
public function get_datanascita(){return $this->datadinascita;}
public function set_datanascita(string $valore){$this->datadinascita=$valore;}
public function get_indirizzo(){return $this->indirizzo;}
public function set_indirizzo (string $valore){$this->indirizzo=$valore;}
public function get_citta(){return $this->citta;}
public function set_citta(string $valore){$this->citta=$valore;}
public function get_telefono (){return $this->telefono;}
public function set_telefono(string $valore){$this->telefono=$valore;}
public function get_listasconti(){return $this->a_listasconti;}
public function set_listasconti (array $valore){$this->a_listasconti=$valore;}
public function get_idutente(){return $this->idutente;}
public function set_idutente(string $valore){$this->idutente=$valore;}
public function get_idregistrazione(){return $this->Idregistrazione;}
public function set_idregistrazione(string $valore){$this->Idegistrazione=$valore;}

}
?>
