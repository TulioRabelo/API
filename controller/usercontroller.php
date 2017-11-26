<?php

//require_once ("model/user.php");
//require_once ("database/database.php");
//require_once ("exception/requestException.php");

class UserController {

	private $allowedOperations = Array('info', 'register','update','delete','login');
	private $request;
	private $collection = 'users';
	
	public function __construct($request) {
		$this->request = $request;
		
	}			  

	public function routeOperation() {

		$body = json_decode($this->request->getBody(),true);
		
		switch($this->request->getOperation()) {

			case 'register':
			if($this->request->getMethod() == "POST")
				return $this->create($body);
			return (new RequestException(400, "Bad request"))->toJson();
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

			case 'login':
				if($this->request->getMethod() == "POST")
					$storedUser = json_decode($this->search($body));
					if(($storedUser[0]->email == $body["email"])&&($storedUser[0]->pass == $body["pass"])){
						return 'foi';
					}
					return "'code':'401', 'message':'Unauthorized'";
				}
					return (new RequestException(400, "Bad request"))->toJson();


			//default:		
					return (new RequestException(400, "Bad request"))->toJson();
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
		 		return "{'code':'200','message':'inserção completa'}";
		 	}
		 	else
		 		http_response_code(417);
		 		return "{'code':'401','message':'falha na inserção'}";
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
		 		return "{'code':'200','message':'operação completa'}";
		 	}
		 	else
		 		http_response_code(417);
		 		return "{'code':'401','message':'falha na operação'}";
		}catch(RequestException $ue) {
			http_response_code(401);
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
//-----------------------------------------------------------------------
	/*private function login($body)
	{
		
		$conditions = array("ativo" => 1, "name" => $body['name']);
		$result = json_decode((new DBHandler())->search($conditions, $this->collection));
		var_dump($result);
		if(count($result) > 0)

			return $this->verifyPassword($body, $result[0]);
		return json_encode(array('401' => 'Unauthorized'));
	}
	private function verifyPassword($body, $userFound) 
	{
		if ($body['pass'] == $userFound->password)
			return json_encode(array('200' => 'Ok'));
		return json_encode(array('401' => 'Unauthorized'));
	}
	*/
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
