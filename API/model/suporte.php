<?php

require_once("validation/suporteValidator.php");
require_once ("exception/requestException.php");

class Suporte {
	
	private $name;
	private $email;
	private $password;
	private $ramal;
	private $sv;

	public function __construct($name, $email, $pass, $ramal) {
	 	$this->sv = new SuporteValidator();
	 	$this->name = $name;
		$this->setEmail($email);
		$this->password = $pass;
		$this->setRamal($ramal);		
	}

	public function setEmail($email) {
		if(!$this->sv->isValidEmail($email)){
			throw new RequestException(400, "Invalid email format");
		}	
		$this->email = $email;
	}
	
	public function setRamal($ramal)
	{	
	if(!$this->sv->isValidRamal($ramal)){
			throw new RequestException(400, "Invalid ramal format");
		}	
		$this->ramal = $ramal;
	}
}
