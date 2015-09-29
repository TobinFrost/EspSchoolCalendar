<?php
require_once 'Controller.class.php';
require 'DataExtractionController.class.php';
class DataAnalyserController extends Controller{
	
	public  $filteredMatiereList = array();
	public  $noFilteredClassList = array();
	public $mainMatiereList = array();
	
	public function __construct($MatiereList){
		parent::__construct();
		$this->mainMatiereList = $MatiereList;
	}
	
	public function execute(){
		//$extract = new DataExtractionController();
		//$extract->execute();
		//var_dump($extract->MatiereList[50]); // It is a good Example of the next Algo . wait and see
		// We have to trie the MatiereList to 
		//echo count($extract->MatiereList);
		for ($i = 0; $i <count($this->mainMatiereList); $i++) { 
			// If a Subject has more than one Teacher we push the Teacher on the current Subject 
			//All Right Let's do it
			$currentMatiere = $this->mainMatiereList[$i];
			//array_push($this->noFilteredClassList, $currentMatiere->Classe);
			//$counter = 0; // the counter of similar Matiere
			if (is_object($currentMatiere)) array_push($this->noFilteredClassList, $currentMatiere->Classe);
			 for ($y = $i+1; $y < count($this->mainMatiereList) ; $y++) {
			 	$comparMatiere = $this->mainMatiereList[$y];
			 	if(!is_null($comparMatiere) && !is_null($currentMatiere)){
			 	if((is_object($comparMatiere) && is_object($currentMatiere)) || (spl_object_hash($comparMatiere) != spl_object_hash($currentMatiere))){
			 		
			 	
			 		
			 	if($currentMatiere->libelle == $comparMatiere->libelle){
			 		//echo $currentMatiere->libelle."<br>";
			 		if($currentMatiere->Semestre == $comparMatiere->Semestre){ // debut test semestre
			 			
			 			if($currentMatiere->Classe == $comparMatiere->Classe){ // debut test classe
					 		//var_dump($currentMatiere);
					 		$currentMatiere->addEnseignant($comparMatiere->Enseignants[0]);
					 		$horaire = array("CM"=>$comparMatiere->CM,"TD"=>$comparMatiere->TD,"TP"=>$comparMatiere->TP);
					 		$currentMatiere->addHoraire($horaire);
							if(spl_object_hash($comparMatiere) != spl_object_hash($currentMatiere)){
								//$extract->destroy($y);
								array_push($this->filteredMatiereList, $currentMatiere);
								
								
							}
			 				
			 			}else{
								array_push($this->filteredMatiereList, $currentMatiere);
						} // fin test classe
			 		} // fin test semestre
			 	}
			 	
			 	} // end of is_object & not the same object test
			 	} // end of is_null test
			 }//end of for loop with $y
			 
		}// end of for loop with $i  

		// in the end .. lol remove all duplicate class
		
	}
	
	
	
}




/**
$ana = new DataAnalyserController();
$ana->execute();
//array_search($ana->filteredMatiereList[3]->libelle, $ana->filteredMatiereList);
var_dump($ana->filteredMatiereList);
//var_dump($ana->filteredMatiereList[4]);
 * 
 * /
 */
