<?php

class Semaine {
	private $Jours; // length must be 7 
	
	public function __construct($JoursTable=NULL){
		if(is_array($JoursTable)){
		$this->Jours = new ArrayObject($JoursTable);
		}else {
		$this->Jours = new ArrayObject(array());
		}
	}// end of Constructor
	
	
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