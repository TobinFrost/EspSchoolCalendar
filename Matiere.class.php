<?php
 class Matiere {
 	private $CM = 0;
 	private $TD = 0;
 	private $TP = 0;
 	private $Annee;
 	private $Semestre;
 	private $noUE;
 	private $noMatiereUE;
 	private $Enseignants = array();
 	private $libelle;
 	private $Classe;
 	
 	
 	
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
 	
 	public function __toString(){
 		return $this->libelle;
 	}
 }