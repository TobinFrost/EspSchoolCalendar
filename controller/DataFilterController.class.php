<?php
require_once 'Controller.class.php';
require "DataAnalyserController.class.php";
class DataFilterController extends Controller{
	public $filteredClassList = array();
	public function __construct(){
		parent::__construct();
	}
	
	public function execute(){
		$ana = new DataAnalyserController();
		$ana->execute();
		$this->filteredClassList = array_unique($ana->noFilteredClassList);
	}
}





