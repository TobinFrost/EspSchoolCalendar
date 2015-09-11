<?php
class Affectation{
	private $Heure;
	private $Matiere;
	
	public function __construct($Matiere,$Heure){
		$this->Heure = $Heure;
		$this->Matiere = $Matiere;
	}
	
	public function __set($property,$value){
			
		if (property_exists($this, $property)){
			$this->$property = $value;
		}
			
			
	}
	
	public function __get($property){
		if (property_exists($this, $property)){
			return $this->$property;
		}
	}
}