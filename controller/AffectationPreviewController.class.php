<?php
require_once 'Controller.class.php';
require_once '../modele/Affectation.class.php';
require_once 'DataAnalyserController.class.php';

class AffectationPreview extends Controller{
	
	public $Classe;
	public $Semestre;
	
	function __construct($ClasseRequest){
		parent::__construct();
	}
	
	function execute(){
		
		$ana = new DataAnalyserController();
		$ana->execute();
		$ana->filteredMatiereList;
		
	}
	
}


$preview  = new AffectationPreview("bla");
$preview->execute();