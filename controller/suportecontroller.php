<?php

require_once ("model/request.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class SuporteController {

	private $allowedOperations = Array('info', 'register', 'update', 'delete');
	private $request;
	private $collection = 'suporte';
	
	public function __construct($request) {
		$this->request = $request;
	}			  

	public function routeOperation() {
		$body = json_decode($this->request->getBody(),true);
		switch($this->request->getOperation()) {
			case 'register':
					return $this->create($body);
			case 'info':
					if($this->request->getMethod() == "GET"){
						return $this->search($this->request->getQueryString());
					}

			case 'update':
					if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
			case 'delete' :
					if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
			//default:		
					return (new RequestException(400, "Bad request"))->toJson();
		}
	}
	
	
	private function create($body) { 	
		try{ 	
		 	new Suporte($body["name"], $body["email"], $body["pass"], $body["ramal"], $body["ativo"]);
		 	//var_dump($body);
		 	//return (new DBHandler())->insert($body, 'users');
		 	$result = (new DBHandler())->insert($body, 'suporte');
		 	//var_dump($result->getInsertedCount);
		 	if($result->getInsertedCount() == 1){
		 		return "{'code':'200','message':'insercao completa'}";
		 	}
		 	else
		 		http_response_code(417);
		 		return "{'code':'401','message':'falha na inserção'}";
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}

	private function search($queryString) {
		return (new DBHandler())->search($queryString,"suporte");
	}
	
	private function update($body, $queryString) {
		try{
			new Suporte($body["name"], $body["email"], $body["pass"], $body["ramal"], $body["ativo"]);
			$result = (new DBHandler())->update($queryString, $body, $this->collection);
			if($result->getModifiedCount() == 1){
		 		return "{'code':'200','message':'operação completa'}";
		 	}
		 	else
		 		http_response_code(417);
		 		return "{'code':'401','message':'falha na operação'}";
		}
		catch(RequestException $ue) {
			http_response_code(417);
			return $ue->toJson();
		}
	}
	
	
	//private function delete($queryString) {
	//	if($queryString != null)
	//		return (new DBHandler())->delete($queryString, $this->collection);
	//	return (new RequestException(400, "Bad request"))->toJson();
	//}

}
