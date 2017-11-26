<?php

include_once ("httpful.phar");

function testGetAllUsers() {

	$response = \Httpful\Request::get('http://localhost/users/search')->send();
	echo $response;

}

function testInsertValidUser() {

	$uri = 'http://localhost/users/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "pepinovsk",
	"email": "pepino@pepinão.com",
	"pass": "pepino",
	"Ramal": "1234",
	"ativo": "1"}')->send();

	if(strcmp($response->body, '{"code":"200","message":"Ok"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
	
function testInsertUserWithInvalidEmail() {

	$uri = 'http://localhost/users/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "batata",
	"email": "pepino@pepinão.ls",
	"pass": "pepino",
	"Ramal": "1234",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
	
function testInserUserWithInvalidName(){
	$uri = 'http://localhost/users/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "pepin111vsk",
	"email": "pepino@pepinão.com",
	"pass": "pepino",
	"Ramal": "1234",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInserUserWithInvalidName2(){
	$uri = 'http://localhost/users/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "pepin%%%sk",
	"email": "pepino@pepinão.com",
	"pass": "pepino",
	"Ramal": "1234",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInserUserWithInvalidPassword(){
	$uri = 'http://localhost/users/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "pepinovsk",
	"email": "pepino@pepinão.com",
	"pass": "",
	"Ramal": "1234",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInserUserWithInvalidRamal(){
	$uri = 'http://localhost/users/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "pepinovsk",
	"email": "pepino@pepinão.com",
	"pass": "pepino",
	"Ramal": "abcdefghijooo",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInserUserWithInvalidRamal(){
	$uri = 'http://localhost/users/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "pepinovsk",
	"email": "pepino@pepinão.com",
	"pass": "pepino",
	"Ramal": "1234567891011",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
}

}
