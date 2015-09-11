<?php
require_once 'PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php';

const TYPE_ENSEIGNANT = 'A';
const NOM = 'B';
const PRENOM = 'C';
const TITRE = 'D';
const TYPE_AFFECTATION = 'E';
const CLASSE = 'F';
const MATIERE = 'G';
const SEMESTRE1 = 'H';
const SEMESTRE2 = 'I';
const CM = 'J';
const TD = 'K';
const TP = 'L';
const TOTAL_COURS = 'P';

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