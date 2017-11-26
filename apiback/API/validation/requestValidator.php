<?php

include_once "IrequestValidator.php";

class RequestValidator implements IRequestValidator 
{
	private $allowedMethods = Array('GET', 'PUT', 'POST');

	private $allowedUris = 
			Array('users' => Array('info', 'register','update','delete'),
				  'suporte' => Array('info','register','update','delete'),
				  'os' => Array('info','register','update','delete'),
				  'groups' => Array('create', 'members', 'info','update','delete'));

	public function isUriValid($uri) {
		$arrayUri = explode('/', $uri);
		//verificar se arrayUri[2] é chave
		if(!in_array($arrayUri[2], $this->allowedUris[$arrayUri[1]]))
			return false;
		
		return true;		
	}

	public function isMethodValid($method) {

		if(!in_array($method, $this->allowedMethods)) 
			return false;

		return true;		
	}

	public function isProtocolValid($protocol) {
		
	}

	

	public function isQueryStringValid($qs) {
		
	}

	public function isBodyValid($body) {
		
	}
}