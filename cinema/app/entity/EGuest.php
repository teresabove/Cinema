<?php
require_once ROOT_DIR.'\app\entity\EUtente.php';

class EGuest {
      // public $username;
       public $password;

       public function __construct(){
       //$this->username='guest'; //valori fittizi per il guest
       $this->password='';}

       
       public function get_username(){return $this->username;}
       public function get_password(){return $this->password;}
       public function set_username(string $valore){$this->username=$valore;}
       public function set_password(string $valore){$this->password=$valore;}
       public function login (string $un, string $pw){      //ritorna sempre un oggetto
                if ($un=='mariorossi'){
                   if ($pw=='red'){
                      $a= new EUtente($un,$pw);
					  return $a;}  //ritorna utente
                   else{
                        print("password errata!");
						return $this;  //se false ritorna guest
                   }}
                else {print("Utente non esistente!");
				return $this;}}
}

?>