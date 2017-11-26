<?php

//TODO: implementar auto requirimento de classes
require_once("autoload.php");  
//require_once ("treater/requestTreater.php");
//spl_autoload_register(function ($class_name) {
//    include $class_name . '.php';
//});
//Externaliza o resultado do processamento da API em formato JSON, sempre.
 echo((new RequestTreater())->start());
