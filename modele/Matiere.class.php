<?php
 class Matiere {
 	public $CM = 0;
 	public $TD = 0;
 	public $TP = 0;
 	public $Annee;
 	public $Semestre;
 	public $noUE;
 	public $noMatiereUE;
 	public $Enseignants = array();
 	public $VolumesHoraires = array();
 	public $libelle;
 	public $Classe;
 	
 	
 	
 	public function __construct($MatiereColumn=null){

 		if(isset($MatiereColumn)){
 		$this->Annee = substr($MatiereColumn, 0,1); // we catch the year
 		$this->Semestre = substr($MatiereColumn, 1,1); // we catch the semestrer
 		$this->noUE = substr($MatiereColumn, 2,1); // we catch the E.U number
 		$this->noMatiereUE = substr($MatiereColumn,3,1); // we catche the Matiere E.U number
 		$strlnght = strlen($MatiereColumn); // we got the length of the string
 		$libelletmp = substr($MatiereColumn,4);
 		$markerpos= strrpos($libelletmp, ":"); // we try to found the position of  ":"
 		$libelletmp = substr_replace($libelletmp, " ", $markerpos,1);// and replace it by ""
 		$this->libelle = $libelletmp;
 		//echo "la position du : est ".$markerpos;
 		}
 	}
 	
 	/**
 	 * @method addHoraire
 	 * @param array $value
 	 * This function add A array of Hours corresponding the last Teacher of Teachers Array
 	 */
 	
 	public function addHoraire($value){
 		// $value must be a array formulated like
 		// array("CM"=>value,"TD"=>value,"TP"=>value)
 		array_push($this->VolumesHoraires,$value);
 		
 	}
 	
 	public function lastHoraire(){
 		return end($this->VolumesHoraires);
 	}
 	
 	public function addFirstHoraire($type,$value){
 		if($type == "CM"){
 			$this->VolumesHoraires[0]["CM"]=$value;
 		}
 		if($type == "TD"){
 			$this->VolumesHoraires[0]["TD"]=$value;
 		}
 		if($type == "TP"){
 			$this->VolumesHoraires[0]["TP"]=$value;
 		}
 	}
 	
 	
 	public function addEnseignant($value){
 		if(is_a($value, "Enseignant",FALSE)){
 			array_push($this->Enseignants,$value);
 		}else{
 			//throw new Exception("Enseignant Expected but Other type Found !");
 			var_dump($value);
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