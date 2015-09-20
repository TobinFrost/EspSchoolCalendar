<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>EspSchoolCalendar</title>

</head>
<body>




<?php

require_once 'PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php';

require_once 'MyReadFilter.class.php';


$inputFileName = 'FusionDonnee.xlsx';

$inputFileType = 'Excel2007';

$objReader = PHPExcel_IOFactory::createReader($inputFileType);

$filterSubset = new MyReadFilter(9,15,range(TYPE_ENSEIGNANT,TP));

$objReader->setReadFilter($filterSubset);

$onePHPExcelObject = $objReader->load($inputFileName);


$sheet = $onePHPExcelObject->getSheet(0); // On récupère le premier feuillet

echo '<table class="table" >';

// On boucle sur les lignes
foreach($sheet->getRowIterator() as $row) {

	echo '<tr>';

	// On boucle sur les cellules de la ligne
	foreach ($row->getCellIterator() as $cell) {
		echo '<td>';
		print_r($cell->getValue());
		echo '</td>';
	}

	echo '</tr>';
}
echo '</table>';


?>

</body>