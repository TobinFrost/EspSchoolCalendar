<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>EspSchoolCalendar</title>

</head>
<body>




<?php

require_once 'PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php';
require_once 'MyReadFilter.class.php';
require_once 'Matiere.class.php';
require_once 'Enseignant.class.php';

$inputFileName = 'FusionDonnee.xlsx';
$inputFileType = 'Excel2007';


$anOtherPHPExcelObject = PHPExcel_IOFactory::load($inputFileName);

//var_dump($anOtherPHPExcelObject->setActiveSheetIndex()->getHighestRowAndColumn()["row"]);

$rowLength = $anOtherPHPExcelObject->setActiveSheetIndex()->getHighestRowAndColumn()["row"];


$objReader = PHPExcel_IOFactory::createReader($inputFileType);

$filterSubset = new MyReadFilter(1,$rowLength,range(TYPE_ENSEIGNANT,TP));

$objReader->setReadFilter($filterSubset);

$onePHPExcelObject = $objReader->load($inputFileName);

$MatiereList = array();
$MatiereTemp = new Matiere();
$ClasseTemp="";
$EnseignantTemp =new Enseignant();
$sheet = $onePHPExcelObject->getSheet(0); // On récupère le premier feuillet
$TeacherInfo = "";

echo '<table class="table" >';

// On boucle sur les lignes

//var_dump($sheet);


foreach($sheet->getRowIterator() as $row) {

//	echo $row->getRowIndex() ."\n";
	
	
	
	echo '<tr>';

	// On boucle sur les cellules de la ligne
	
//	var_dump($row->getCellIterator());
	
	foreach ($row->getCellIterator() as $cell) {
		$column = $cell->getColumn();
		$valeur = $cell->getValue();
		echo '<td>';
		
		//print_r($cell->getCoordinate());
		//print_r($cell->getColumn());
		if($column == TYPE_ENSEIGNANT){
			$EnseignantTemp->Type = $valeur;
			echo $valeur." ";
			$TeacherInfo = $TeacherInfo."|".$valeur;
		}
		
		if($column == NOM){
			$TeacherInfo = $TeacherInfo."|".$valeur;
			$EnseignantTemp->Nom = $valeur;
			//echo $valeur." ";
		}
		
		if ($column == PRENOM){
			$TeacherInfo = $TeacherInfo."|".$valeur;
			$EnseignantTemp->Prenom = $valeur;
			//echo $valeur." ";
		}
		if($column == TITRE){
			$TeacherInfo = $TeacherInfo."|".$valeur;
			$EnseignantTemp->Grade = $valeur;
			//echo $valeur." ";
		}
		
		if($column == TYPE_AFFECTATION){
			$TeacherInfo = $TeacherInfo."|".$valeur;
			$EnseignantTemp->Affectation = $valeur;
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
			array_push($MatiereList, $matiere);
			//print_r($cell->getValue());
			$TeacherInfo = $TeacherInfo."\n";
			
			//echo $TeacherInfo;
		}
		
		if($column == CM){
			
			end($MatiereList)->CM = $valeur;
		}
		
		if($column == TD){
				
			end($MatiereList)->TD = $valeur;
		}
		
		if($column == TP){
		
			end($MatiereList)->TP = $valeur;
		}
		
		
//		print_r($cell->getValue());
		
		//unset($EnseignantTemp);
		
		
		echo '</td>';
	}
/**		$EnseignantTemp->Type=null;
		$EnseignantTemp->Nom=null;
		$EnseignantTemp->Prenom =null; **/
	
	echo '</tr>';
	
	$TeacherInfo = "";
}
echo '</table>';

//var_dump($MatiereTemp);
 
//print_r($MatiereList[100]);

var_dump($MatiereList[100]);

?>

</body>