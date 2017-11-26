<?php

require_once ("model/user.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class UserController {

	private $allowedOperations = Array('info', 'register','update','delete');
	private $request;
	private $collection = 'users';
	
	public function __construct($request) {
		$this->request = $request;
		
	}			  

	public function routeOperation() {
		$body = json_decode($this->request->getBody(),true);
		switch($this->request->getOperation()) {
			case 'register':
					return $this->create($body);
			case 'info':
					if($this->request->getMethod() == "GET")
						
						return $this->search($this->request->getQueryString());
			case 'update':
					if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
			case 'delete' :
					if($this->request->getMethod() == "PUT")
						return $this->delete($this->request->getQueryString());
			//default:		
					return (new RequestException(400, "Bad request"))->toJson();
		}
	}
	
	
	private function create($body) { 	
		try{ 	
		 	new User($body["name"], $body["email"], $body["pass"], $body["cpf"]);
		 	return (new DBHandler())->insert($body, 'users');
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}

	private function search($queryString) {
		return (new DBHandler())->search($queryString);
	}
	
	private function update($body, $queryString) {
		try{
			new User($body["name"], $body["email"], $body["pass"], $body["cpf"]);
			$set = ['$set' => $body];
			return (new DBHandler())->update($queryString, $set, $this->collection);
		}catch(RequestException $ue) {
			return $ue->toJson();
		}
	}
	
	private function delete($queryString) {
		if($queryString != null)
			return (new DBHandler())->delete($queryString, $this->collection);
		return (new RequestException(400, "Bad request"))->toJson();
	}

}
