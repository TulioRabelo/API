<?php

class SuporteValidator {

public function isValidEmail($email) {
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		return false;
	return true;
}

public function isValidRamal($ramal){
	if(!filter_var($ramal,FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>9999))))
		return false;
	return true;
}

}