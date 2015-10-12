<?php
class Affectation{
	private $Heure;
	private $Matiere;
	
	public function __construct($Matiere=null,$Heure=null){
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
	
	public function __clone(){
		$this->Heure = $this->Heure;
		$this->Matiere = $this->Matiere;
	}
}