<?php

class FlyweightHeureFactory{
	private $Heures = array();
	
	public function __construct(){
		$this->Heures[1] = NULL;
		$this->Heures[2] = NULL;
		$this->Heures[3] = NULL;
		$this->Heures[4] = NULL;
		
	}
	function getHeure($heureKey){
		if ($this->Heures[$heureKey] == NULL){
			$makeFunction = 'makeHeure'.$heureKey;
			$this->Heures[$heureKey] = $this->$makeFunction();
		}
	}
	
	function makeHeure1(){

		$heure = new FlyweightHeure("8","10");
		
		return $heure;
	}
	
	function makeHeure2(){
	
		$heure = new FlyweightHeure("10","12");
	
		return $heure;
	}
	
	function makeHeure3(){
	
		$heure = new FlyweightHeure("14.30","16.30");
	
		return $heure;
	}
	
	function makeHeure4(){
	
		$heure = new FlyweightHeure("16.30","18.30");
	
		return $heure;
	}
	
}