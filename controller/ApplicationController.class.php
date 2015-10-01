<?php
require 'Controller.class.php';
require_once 'AffectationPreviewController.class.php';
require_once 'DataAnalyserController.class.php';
require_once 'DataExtractionController.class.php';
require_once 'DataFilterController.class.php';
class ApplicationController extends Controller{
	
	public $PrincipaleMatiereList;
	
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
			$preview->execute();
			//var_dump($preview->RequestMatiere);
			include_once '../view/AffectationView.php';
		} // This is for showing Affectation Table
		
	}
	
}

$app = new ApplicationController();

$app->execute();