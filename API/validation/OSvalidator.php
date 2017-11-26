<?php

class OSValidator {

public function isValidEquipamento($equipamento) {
	if(!filter_var($equipamento,FILTER_VALIDATE_EQUIPAMENTO))
		if(!filter_var($equipamento,FILTER_VALIDATE_STRING, array("options" => array("min_range"=>0, "max_range"=>9999))))
		return false;
	if(!filter_var($equipamento,FILTER_VALIDATE_STRING, array("options" != array("min_range"=>0, "max_range"=>9999))))
		return false;
	return true;
}

public function isValidLaudo($laudo) {
	if(!filter_var($laudo,FILTER_VALIDATE_LAUDO))
		
	if(!filter_var($laudo,FILTER_VALIDATE_STRING, array("laudo" == '')))
		return false;
	return true;
}
public function isValidDefeito($defeito){
	if(!filter_var($defeito,FILTER_VALIDATE_DEFEITO, array("options" => array("min_range"=>0, "max_range"=>9999))))
		
		return false;
		if(!filter_var($defeito,FILTER_VALIDATE_DEFEITO, array("options" => array(''))))
			return false;
		
		if(!filter_var($defeito,FILTER_VALIDATE_DEFEITO, array("options" != array("min_range"=>0, "max_range"=>9999))))
		return false;
	return true;

}
}
