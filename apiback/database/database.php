<?php

class DBHandler {

	const DB_NAME = "test";

	public function getConnection() {
		try {

		    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

		    return $mng;

		} catch (MongoDB\Driver\Exception\Exception $e) {
		    
		    return json_encode(
		    			 	Array(
		    			 		"msg"  => $e->getMessage(), 
		    			 		"file" => $e->getFile(), 
		    			 		"line" => $e->getLine()
		    			 	));       
		}
	}

	public function insert($document, $collection) {
		$conn = $this->getConnection();
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert($document);
		$result = $conn->executeBulkWrite(
										"test.".$collection,
										 $bulk);
		return $result;
	}

	public function search($parameters, $collection) {
		$conn = $this->getConnection();
		$query = new MongoDB\Driver\Query($parameters, []);
		$rows = $conn->executeQuery("test.".$collection, $query);
		$result = Array();
		foreach ($rows as $row) {
    
        array_push($result, $row);
    }
		return json_encode($result);
	}
	
	/*	public function searchSuporte($parameters) {
		$conn = $this->getConnection();
		$query = new MongoDB\Driver\Query($parameters, []);
		$rows = $conn->executeQuery("test.suporte", $query);
		$result = Array();
		foreach ($rows as $row) {
    
        array_push($result, $row);
    }
		return json_encode($result);
	}
	
	public function searchOS($parameters) {
		$conn = $this->getConnection();
		$query = new MongoDB\Driver\Query($parameters, []);
		$rows = $conn->executeQuery("test.servico", $query);
		$result = Array();
		foreach ($rows as $row) {
    
        array_push($result, $row);
    }
		return json_encode($result);
	}*/

	public function update($querystring, $set, $collection) {
		$conn = $this->getConnection();
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update($querystring, $set);
		$result = $conn->executeBulkWrite(
										"test.".$collection,
										 $bulk);
		return $result;
	}
	public function delete($querystring, $collection) {
		$conn = $this->getConnection();
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->delete($body);
		$result = $conn->executeBulkWrite(
										"test.".$collection,
										 $bulk);
		return $result;
	}

}