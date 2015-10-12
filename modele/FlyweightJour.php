<?php
class FlyweightJour {
	
	private $libelle;
	
	public function __construct($lib){
		$this->libelle = $lib;
	}
	
	public function getLibelle(){
		return $this->libelle;
	}
}