<?php
require_once 'FlyweightJour.php';
class FlyweightJourFactory{
	private $Jours=array();
	
	public function __construct(){
		$this->Jours[0] = null;
		$this->Jours[1] = null;
		$this->Jours[2] = null;
		$this->Jours[3] = null;
		$this->Jours[4] = null;
		$this->Jours[5] = null;
	}
	
	function getJours($jourKey){
		if($this->Jours[$jourKey]== null){
			$makeFunction = 'makeJour'.$jourKey;
			$this->Jours[$jourKey] = $this->$maFunction();
		}
	}
	
	public function makeJour1(){
		$jour = new FlyweightJour("Lundi");
		return $jour->getLibelle();
	}
	
	public function makeJour2(){
		$jour = new FlyweightJour("Mardi");
		return $jour->getLibelle();
	}
	
	public function makeJour3(){
		$jour = new FlyweightJour("Mercredi");
		return $jour->getLibelle();
	}
	
	public function makeJour4(){
		$jour = new FlyweightJour("Jeudi");
		return $jour->getLibelle();
	}
	
	public function makeJour5(){
		$jour = new FlyweightJour("Vendredi");
		return $jour->getLibelle();
	}
	
	public function makeJour6(){
		$jour = new FlyweightJour("Samedi");
		return $jour->getLibelle();
	}
}