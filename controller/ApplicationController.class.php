<?php
session_start();
require 'Controller.class.php';
require_once 'AffectationPreviewController.class.php';
require_once 'DataAnalyserController.class.php';
require_once 'DataExtractionController.class.php';
require_once 'DataFilterController.class.php';
require_once 'GenerationController.class.php';
require_once '../modele/Matiere.class.php';
class ApplicationController extends Controller{
	
	public $PrincipaleMatiereList;
	public $MatiereListToGenerate;
	public $Classe;
	public $Semestre;
	function __construct(){
		parent::__construct();
	}
	
	function execute(){
		$extr = new DataExtractionController();
		$extr->execute();
		$this->PrincipaleMatiereList = $extr->MatiereList;
		
		if(isset($_POST["ClassList"])){
			
		$ana = new DataAnalyserController($this->PrincipaleMatiereList);
		$ana->execute();
		//var_dump($ana->filteredMatiereList[5]);
		$filter = new DataFilterController($ana->noFilteredClassList);
		$filter->execute();
		//var_dump($filter->filteredClassList);
		include_once '../view/MainPageView.php';
		
		} // This is for showing Classe List
		
		
		
		if(isset($_POST["AffectationList"])){
			$preview = new AffectationPreview($_POST["AffectationList"], $this->PrincipaleMatiereList);
			$this->Classe = $preview->Classe;
			$this->Semestre = $preview->Semestre;
			$preview->execute();
			$this->MatiereListToGenerate = $preview->RequestMatiere;
			$_SESSION["Classe"] = $this->Classe;
			$_SESSION["Semestre"] = $this->Semestre;
			$_SESSION["MatiereListToGenerate"] = $this->MatiereListToGenerate;
			 
			//var_dump($preview->RequestMatiere);
			include_once '../view/AffectationView.php';
		} // This is for showing Affectation Table
		
		
		if(isset($_POST["GenerationEmploi"])){
			
				
			$preview = new AffectationPreview($_POST["GenerationEmploi"], $this->PrincipaleMatiereList);
			$this->Classe = $preview->Classe;
			$this->Semestre = $preview->Semestre;
			$preview->execute();
			$this->MatiereListToGenerate = $preview->RequestMatiere;
			
			if(isset($this->MatiereListToGenerate)){
				$gene = new GenerationController($this->MatiereListToGenerate);
				$gene->execute();
				$gene->generate($this->Semestre,$this->Classe,"2015");
				
			}else{
				echo "Vous devez selectionner une Formation et un Semestre ";
			}
			
		}
	}
	
}


function castMatiere($ma){
	return $ma;
}

$app = new ApplicationController();

$app->execute();