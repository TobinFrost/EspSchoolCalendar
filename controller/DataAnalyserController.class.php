<?php
require_once 'Controller.class.php';
require 'DataExtractionController.class.php';
class DataAnalyserController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function execute(){
		$extract = new DataExtractionController();
		$extract->execute();
		//var_dump($extract->MatiereList[50]); // It is a good Example of the next Algo . wait and see
		// We have to trie the MatiereList to 
		//echo count($extract->MatiereList);
		for ($i = 0; $i <count($extract->MatiereList); $i++) { 
			// If a Subject has more than one Teacher we push the Teacher on the current Subject 
			//All Right Let's do it
			$currentMatiere = $extract->MatiereList[$i] ;
			 for ($y = $i+1; $y < count($extract->MatiereList) ; $y++) {
			 	$comparMatiere = $extract->MatiereList[$y];
			 	if($currentMatiere->libelle == $comparMatiere->libelle){
			 		//echo $currentMatiere->libelle."<br>";
			 		if($currentMatiere->Semestre == $comparMatiere->Semestre){ // debut test semestre
			 			
			 			if($currentMatiere->Classe == $comparMatiere->Classe){ // debut test classe
					 		var_dump($currentMatiere);
					 		$currentMatiere->addEnseignant($comparMatiere->Enseignants[0]);
					 		$horaire = array("CM"=>$comparMatiere->CM,"TD"=>$comparMatiere->TD,"TP"=>$comparMatiere->TP);
					 		$currentMatiere->addHoraire($horaire);
					 		//$extract->MatiereList[$y] = null;
			 		//
			 			} // fin test classe
			 		} // fin test semestre
			 	}
			 }
		} 
		
	}
}


$ana = new DataAnalyserController();
$ana->execute();