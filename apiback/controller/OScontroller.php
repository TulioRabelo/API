<?php

require_once ("model/OrdemServico.php");
require_once ("database/database.php");
require_once ("exception/requestException.php");

class OSController {

	private $allowedOperations = Array('info', 'register', 'update', 'delete');
	private $request;
	private $collection = 'os';
	
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
		 	new OrdemServico($body["equipamento"], $body["defeito"], $body["laudo"]/*, $body["entrada"],$body["saida"]*/);
		 	$result = (new DBHandler())->insert($body, 'os');
		 	//var_dump($result->getInsertedCount);
		 	if($result->getInsertedCount() == 1){
		 		return "{'code':'200','message':'insercao completa'}";
		 	}
		 	else
		 		return "deu errado";
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}

	private function search($queryString) {
		return (new DBHandler())->search($queryString,"os");
	}
	
	private function update($body, $queryString) {
		try{
			new OrdemServico($body["equipamento"], $body["defeito"], $body["laudo"]/*, $body["entrada"],$body["saida"]*/);
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
