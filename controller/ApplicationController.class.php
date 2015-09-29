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
		$ana = new DataAnalyserController($this->PrincipaleMatiereList);
		$ana->execute();
		//var_dump($ana->filteredMatiereList[5]);
		$filter = new DataFilterController($ana->noFilteredClassList);
		$filter->execute();
		//var_dump($filter->filteredClassList);
		$preview = new AffectationPreview("Master-1.GL_S2", $this->PrincipaleMatiereList);
		$preview->execute();
	}
	
}

$app = new ApplicationController();

$app->execute();