<?php
require_once 'FlyweightHeure.php';
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

		$heure = new FlyweightHeure("08H00","10H00");
		
		return $heure;
	}
	
	function makeHeure2(){
	
		$heure = new FlyweightHeure("10H00","12H00");
	
		return $heure;
	}
	
	function makeHeure3(){
	
		$heure = new FlyweightHeure("14H30","16H30");
	
		return $heure;
	}
	
	function makeHeure4(){
	
		$heure = new FlyweightHeure("16H30","18H30");
	
		return $heure;
	}
	
}