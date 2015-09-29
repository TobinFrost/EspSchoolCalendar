<?php
require_once 'Controller.class.php';
require_once "DataAnalyserController.class.php";
class DataFilterController extends Controller{
	public $filteredClassList = array();
	public function __construct($noFilteredClassList){
		parent::__construct();
		$this->filteredClassList = $noFilteredClassList;
	}
	
	public function execute(){
		$this->filteredClassList = array_unique($this->filteredClassList);
	}
}





