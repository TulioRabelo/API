<?php

include_once ("httpful.phar");


function testGetAllUsers() {

	$response = \Httpful\Request::get('http://localhost/users/info')->send();

	echo $response;
}

function testInsertUserWithInvalidEmail() {

	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "batata",
	"email": "batataasdasdaas",
	"pass": "batata",
	"bdate": "0009-09-12"}')->send();

	return strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0;


}

function testInsertValidUser() {

	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "batata",
	"email": "batata@gmail.com",
	"pass": "batata",
	"bdate": "0009-09-12"}')->send();

	return strcmp($response->body, '{"code":200,"message":"OK"}') == 0;


}
