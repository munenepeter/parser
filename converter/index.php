<?php

include_once 'SimpleXLSX.php';
echo '<pre>';

// open
$filename = 'test3.xlsx';

$xlsx = Test\SimpleXLSX::parseFile( $filename, $debug = false );

// simple
// $xlsx->rows($worksheetIndex = 0, $limit = 0): array
// $xlsx->readRows($worksheetIndex = 0, $limit = 0): Generator - helps read huge xlsx
//print $xlsx->toHTMLEx(1);
// extended
// $xlsx->rowsEx($worksheetIndex = 0, $limit = 0): array
// $xlsx->readRowsEx($worksheetIndex = 0, $limit = 0): Generator - helps read huge xlsx with styles
// $xlsx->toHTMLEx($worksheetIndex = 0, $limit = 0): string
// meta
// $xlsx->dimension($worksheetIndex):array [num_cols, num_rows]
// $xlsx->sheetsCount():int
// $xlsx->sheetNames():array
// $xlsx->sheetName($worksheetIndex):string
// $xlsx->sheetMeta($worksheetIndex = null):array sheets metadata (null = all sheets)
// $xlsx->isHiddenSheet($worksheetIndex):bool

//print $xlsx->getStyles();

// foreach ($xlsx->sheetNames() as $sheet) {
//     print $sheet;
// }


for ($i = 0; $i < count($xlsx->sheetNames()); $i++) {
echo $i;
  //  print $xlsx->sheetName($i) . $xlsx->toHTMLEx($i);
}