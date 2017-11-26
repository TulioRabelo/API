<?php

include_once ("httpful.phar");

function testGetAllOrdemDeServiço() {
	$response = \Httpful\Request::get('http://localhost/admin/search')->send();
	echo $response;
}

function testInsertValidOS() {
	$uri = 'http://localhost/admin/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"equipamento": "Processador",
	"defeito": "Queimado",
	"laudo": "Devido ao uso sem ventilação"
	"ativo": "1"}')->send();

	if(strcmp($response->body, '{"code":"200","message":"Ok"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
	
function testInsertAdminWithInvalidEquipamento() {
	$uri = 'http://localhost/admin/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"equipamento": "12154",
	"defeito": "Queimado",
	"laudo": "Devido ao uso sem ventilação",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
	
function testInsertAdminWithInvalidDefeito(){
	$uri = 'http://localhost/admin/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"equipamento": "Processador",
	"defeito": "2313154",
	"laudo": "Devido ao uso sem ventilação",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInsertAdminWithInvalidLaudo(){
	$uri = 'http://localhost/admin/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"equipamento": "Processador",
	"defeito": "Queimado",
	"laudo": "2131454",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInsertAdminWithInvalidEquipamento2(){
	$uri = 'http://localhost/admin/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"equipamento": "%&¢¢¢¢",
	"defeito": "Queimado",
	"laudo": "Devido ao uso sem ventilação",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInsertAdminWithInvalidDefeito2(){
	$uri = 'http://localhost/admin/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"equipamento": "Processador",
	"defeito": "%&¢¢¢¢",
	"laudo": "Devido ao uso sem ventilação",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInserAdminWithInvalidLaudo2(){
	$uri = 'http://localhost/admin/signUp';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"equipamento": "Processador",
	"defeito": "Queimado",
	"laudo": "%&¢¢¢¢",
	"ativo": "1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
}
}
