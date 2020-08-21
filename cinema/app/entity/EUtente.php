<?php
require_once 'app\foundation\FRegistrazione.php';
require_once 'app\entity\EGuest.php';
require_once 'app\entity\EProfilo.php';

class EUtente extends EGuest {
      public $email;
      public $profilo;
      
      public function __construct()
	  {
	  }

	  public function costruttore_registrazione(string $password, string $email){
          $this->password=$password;
          $this->email=$email;
      }

    public function costruttore(string $un,string $pw, EProfilo $Profilo)
    {
        $this->set_username($un);
        $this->set_password($pw);
        $this->validazione=true;
    }
      public function get_email(){return $this->email;}
      public function get_validazione(){return $this->validazione;}
      public function set_email(string $valore){$this->email=$valore;}
      public function set_validazione(string $valore){$this->validazione=$valore;}
      public function get_idregistrazione(){return $this->idregistrazione;}
      public function set_idregistrazione(string $idregistrazione){$this->idregistrazione=$idregistrazione;}
      
      }

?>
