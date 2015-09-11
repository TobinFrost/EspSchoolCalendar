<?php
require_once 'PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php';

$inputFileName = 'FusionDonnee.xlsx';

$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

echo '<hr />';

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
var_dump($sheetData);
