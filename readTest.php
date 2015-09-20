<?php
require_once 'PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php';



class MyReadFilter implements PHPExcel_Reader_IReadFilter
{
	private $_startRow = 0;

	private $_endRow = 0;

	private $_columns = array();

	public function __construct($startRow, $endRow, $columns) {
		$this->_startRow	= $startRow;
		$this->_endRow		= $endRow;
		$this->_columns		= $columns;
	}

	public function readCell($column, $row, $worksheetName = '') {
		if ($row >= $this->_startRow && $row <= $this->_endRow) {
			if (in_array($column,$this->_columns)) {
				return true;
			}
		}
		return false;
	}
}


if(isset($_POST["myFile"])){
	

	
	
	
$onePHPExcelObject = PHPExcel_IOFactory::load("FusionDonnee.xlsx");


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

}