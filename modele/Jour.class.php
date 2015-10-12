<?php

class Jour{
	private $Affectations; // length must be 4 max and 2 min
	private $LibelleJour="";
	private $nextJour = array();
	
	public function __construct($Libelle,$AffectationTable){
		
		if(ctype_alpha($Libelle)){
			$this->LibelleJour = $Libelle;
		}
		
		if(is_array($AffectationTable)){
			$this->Affectations = new ArrayObject($AffectationTable);
			
			//$this->Affectations->uasort('cmp');
			//$this->Affectations->
			$this->arrangerAffectation();
		}
		
		if(is_a($AffectationTable, ArrayObject::class)){
			$this->Affectations = $AffectationTable;
			
			//$this->Affectations->uasort('cmp');
			$this->arrangerAffectation();
		}
		
		
		//$this->arrangerAffectation();
	}
	
	public function arrangerAffectation(){
		$count = $this->Affectations->count();
		$i = 0;
		while ($count>0) {
			if (is_null($this->Affectations[$i])){
				$this->Affectations->offsetUnset($i);
				
			}
			$i++;
			$count--;
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
// Comparation function of the Tri
 function cmp($a, $b) {
	if ($a->Heure->getHoraireDebut() == $b->Heure->getHoraireDebut()) {
		return 0;
	}
	return ($a->Heure->getHoraireDebut() < $b->Heure->getHoraireDebut()) ? -1 : 1;
}