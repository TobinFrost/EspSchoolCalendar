<?php
//require_once ('../lib/autoload2.inc.php');
require_once '../PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php';
require_once '../modele/MyReadFilter.class.php';
require_once '../modele/Matiere.class.php';
require_once '../modele/Enseignant.class.php';
require_once 'Controller.class.php';
class DataExtractionController extends Controller{

	private $MatiereList = array();
	private $inputFileName = '../FusionDonnee.xlsx';
	private $inputFileType = 'Excel2007';
	
	public function __construct(){
		parent::__construct();
	}
	
	
	public function execute(){
		
		$anOtherPHPExcelObject = PHPExcel_IOFactory::load($this->inputFileName);
		
		//var_dump($anOtherPHPExcelObject->setActiveSheetIndex()->getHighestRowAndColumn()["row"]);
		
		$rowLength = $anOtherPHPExcelObject->setActiveSheetIndex()->getHighestRowAndColumn()["row"];
		
		
		$objReader = PHPExcel_IOFactory::createReader($this->inputFileType);
		
		$filterSubset = new MyReadFilter(1,$rowLength,range(TYPE_ENSEIGNANT,TP));
		
		$objReader->setReadFilter($filterSubset);
		
		$onePHPExcelObject = $objReader->load($this->inputFileName);
		
		$MatiereTemp = new Matiere();
		$ClasseTemp="";
		$EnseignantTemp =new Enseignant();
		$sheet = $onePHPExcelObject->getSheet(0); // On récupère le premier feuillet
		$TeacherInfo = "";
		
		foreach($sheet->getRowIterator() as $row) {
			
			foreach ($row->getCellIterator() as $cell) {
				$column = $cell->getColumn();
				$valeur = $cell->getValue();
				
			
				//print_r($cell->getCoordinate());
				//print_r($cell->getColumn());
				if($column == TYPE_ENSEIGNANT){
					//$EnseignantTemp->Type = $valeur;
					$TeacherInfo = $TeacherInfo."|".$valeur;
				}
			
				if($column == NOM){
					$TeacherInfo = $TeacherInfo."|".$valeur;
					//$EnseignantTemp->Nom = $valeur;
					//echo $valeur." ";
				}
			
				if ($column == PRENOM){
					$TeacherInfo = $TeacherInfo."|".$valeur;
					//$EnseignantTemp->Prenom = $valeur;
					//echo $valeur." ";
				}
				if($column == TITRE){
					$TeacherInfo = $TeacherInfo."|".$valeur;
					//$EnseignantTemp->Grade = $valeur;
					//echo $valeur." ";
				}
			
				if($column == TYPE_AFFECTATION){
					$TeacherInfo = $TeacherInfo."|".$valeur;
					//$EnseignantTemp->Affectation = $valeur;
				}
			
				if($column == CLASSE){
					$ClasseTemp = $cell->getValue();
				}
			
				if($column == MATIERE){
					$matiere  = new Matiere($cell->getValue());
					$enseignant = new Enseignant($TeacherInfo);
					$matiere->Classe = $ClasseTemp;
					$matiere->addEnseignant($enseignant);
					$MatiereTemp = $matiere;
					array_push($this->MatiereList, $matiere);
					//print_r($cell->getValue());
					$TeacherInfo = $TeacherInfo."\n";
						
					//echo $TeacherInfo;
				}
			
				if($column == CM){
						
					end($this->MatiereList)->CM = $valeur;
					end($this->MatiereList)->addFirstHoraire("CM",$valeur);
				}
			
				if($column == TD){
			
					end($this->MatiereList)->TD = $valeur;
					end($this->MatiereList)->addFirstHoraire("TD",$valeur);
				}
			
				if($column == TP){
			
					end($this->MatiereList)->TP = $valeur;
					end($this->MatiereList)->addFirstHoraire("TP",$valeur);
				}
			}
			
			$TeacherInfo = ""; //Initialize Teacher information
		}
	}// end of Execution Algorithm
	
	public function process(){
		
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

//$ex = new DataExtractionController();
//$ex->execute();
//var_dump($ex->MatiereList[100]);