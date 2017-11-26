<?php

//require_once ("model/user.php");
//require_once ("database/database.php");
//require_once ("exception/requestException.php");

class UserController {

	private $allowedOperations = Array('info', 'register','update','delete');
	private $request;
	private $collection = 'users';
	
	public function __construct($request) {
		$this->request = $request;
		
	}			  

	public function routeOperation() {

		//var_dump($this->request);
		$body = json_decode($this->request->getBody(),true);

		switch($this->request->getOperation()) {
			
			case 'register':

				return $this->create($body);

			case 'info':
					if($this->request->getMethod() == "GET")
						
						return $this->search($this->request->getQueryString());

					return (new RequestException(400, "Bad request"))->toJson();
			case 'update':
					if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
			case 'delete' :
					if($this->request->getMethod() == "PUT")
						return $this->update($body, $this->request->getQueryString());
					
					return (new RequestException(400, "Bad request"))->toJson();


			//default:		
					return (new RequestException(400, "Bad request"))->toJson();
		}
	}
	
	
	private function create($body) { 	
		try{ 	
			//var_dump($body);
		 	new User($body["name"], $body["email"], $body["pass"], $body["cpf"], $body["ativo"]);
		 	//var_dump($body);
		 	//return (new DBHandler())->insert($body, 'users');
		 	$result = (new DBHandler())->insert($body, 'users');
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
		return (new DBHandler())->search($queryString, 'users');
	}
	
	private function update($body, $queryString) {
		try{
			new User($body["name"], $body["email"], $body["pass"], $body["cpf"], $body["ativo"]);
			$result = (new DBHandler())->update($queryString, $body, $this->collection);
			if($result->getModifiedCount() == 1){
		 		return "{'code':'200','message':'insercao completa'}";
		 	}
		 	else
		 		return "{'code':'','message':''}";
		}catch(RequestException $ue) {
			http_response_code(400);
			return $ue->toJson();
		}
	}

	private function delete($body, $queryString) {
		try{
			new User($body["name"], $body["email"], $body["pass"], $body["cpf"], $body["ativo"]);
			return (new DBHandler())->update($queryString, $body, $this->collection);
		}catch(RequestException $ue) {
			return $ue->toJson();
		}
	}
	
	/*private function delete($queryString) {
		/*if($queryString != null)
			return (new DBHandler())->delete($queryString, $this->collection);
		return (new RequestException(400, "Bad request"))->toJson();
	}*/
	/*try{ 	
		 	new User($body["name"], $body["email"], $body["pass"], $body["cpf"], $body["ativo"]);
		 	return (new DBHandler())->update($queryString, $body, $this->collection);//nome da collection no meu mongo LOCAL
		 }catch(RequestException $ue) {
		 	 return $ue->toJson();
		 }	
	}*/

}
