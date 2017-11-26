<?php

require_once("validation/OSValidator.php");
require_once ("exception/requestException.php");

class OrdemServico {
	private $equipamento;
	private $defeito;
	private $laudo;
	//private $entrada;
	//private $saida;

	public function __construct($equipamento, $defeito, $laudo/*,$entrada,$saida*/) {
	 	$this->osv = new OSValidator();
		$this->setEquipamento($equipamento);
		$this->setDefeito($defeito);
		$this->setLaudo($laudo);
		//$this->setEntrada= $entrada;
		//$this->setSaida= $saida;			
	}

	
	
	public function getEquipamento() {
		return $this->equipamento;
	}

	public function setEquipamento($equipamento) {
		if(!$this->osv->isValidEquipamento($equipamento)){
			throw new RequestException(400, "Invalid equipament format");
		}	
		$this->equipamento = $equipamento;
	}

	public function getDefeito() {
		return $this->defeito;
	}

	public function setDefeito($defeito) {
		if(!$this->osv->isValidDefeito($defeito)){
			throw new RequestException(400, "Invalid defeito format");
		}	
		$this->defeito = $defeito;
	}

	public function getLaudo() {
		return $this->laudo;
	}

	public function setLaudo($laudo) {
		if(!$this->osv->isValidLaudo($laudo)){
			throw new RequestException(400, "Invalid laudo format");
		}	
		$this->laudo = $laudo;
	}

	/*public LocalDate getEntrada() {
		return entrada;
	}

	public void setEntrada(LocalDate entrada) {
		this.entrada = entrada;
	}

	public LocalDate getSaida() {
		return saida;
	}

	public void setSaida(LocalDate saida) {
		this.saida = saida;
	}*/
	
}
