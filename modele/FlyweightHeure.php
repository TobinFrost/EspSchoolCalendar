<?php
class FlyweightHeure{
	private $HoraireDebut;
	private $HoraireFin;
	public function __construct($HoraireDebut,$HoraireFin){
		$this->HoraireDebut = $HoraireDebut;
		$this->HoraireFin = $HoraireFin;
	} 
	
	public function getHoraireDebut(){
		return $this->HoraireDebut;
	} 
	
	public function getHoraireFin(){
		return $this->HoraireFin;
	}
	
	public function setHoraireDebut($h){
		$this->HoraireDebut = $h;
	}
	
	public function setHoraireFin($h){
		$this->HoraireFin = $h;
	}
	
	public function __toString(){
		return $this->HoraireDebut.$this->HoraireFin;
	}
}