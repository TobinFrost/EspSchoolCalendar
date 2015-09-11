<?php

class Semaine {
	private $Jours;
	
	public function __construct($JoursTable){
		if(is_array($JoursTable)){
		$this->Jours = new ArrayObject($JoursTable);
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