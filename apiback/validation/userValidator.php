<?php

class UserValidator {

public function isValidEmail($email) {
	//var_dump($email);
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		return false;
	return true;
}

public function isValidRamal($ramal){
	if(!filter_var($ramal,FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>9999))))
		return false;
	return true;
}
public function isValidCpf($cpf){
	$invalidos = array('00000000000',
	'11111111111',
	'22222222222',
	'33333333333',
	'44444444444',
	'55555555555',
	'66666666666',
	'77777777777',
	'88888888888',
	'99999999999');
	$cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
	// Valida tamanho
	if (strlen($cpf) != 11)
		return false;
	// Calcula e confere primeiro dígito verificador
	for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
		$soma += $cpf{$i} * $j;
	$resto = $soma % 11;
	if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	// Calcula e confere segundo dígito verificador
	for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
		$soma += $cpf{$i} * $j;
	$resto = $soma % 11;
	if (in_array($cpf, $invalidos))
		return false;
	return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}
}
