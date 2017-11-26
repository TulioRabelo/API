<?php

require_once("validation/userValidator.php");
require_once ("exception/requestException.php");

class User {
	
	private $name;
	private $email;
	private $password;
	private $cpf;
	private $uv;

	public function __construct($name, $email, $pass, $cpf) {
	 	$this->uv = new UserValidator();
	 	$this->name = $name;
		$this->setEmail($email);
		$this->password = $pass;
		$this->setCpf($cpf);		
	}

	public function setEmail($email) {
		if(!$this->uv->isValidEmail($email)){
			throw new RequestException(400, "Invalid email format");
		}	
		$this->email = $email;
	}
	public function setCpf($cpf)
	{
		if(!$this->uv->isValidCpf($cpf)){
			throw new RequestException(400, "Invalid cpf format");
		}	
		$this->cpf = $cpf;
	}
	
}
