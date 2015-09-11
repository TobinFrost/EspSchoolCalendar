<?php
class Jour{
	private $Affectations;
	private $LibelleJour="";
	public function __construct($Libelle,$AffectationTable){
		if(is_array($AffectationTable)){
			$this->Affectations = new ArrayObject($AffectationTable);
		}
		
		if(ctype_alpha($Libelle)){
			$this->LibelleJour = $Libelle;
		}
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