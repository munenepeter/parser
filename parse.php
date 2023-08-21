<?php

use Smalot\PdfParser\Parser;
 
include 'vendor/autoload.php';

$filename = __DIR__ . '/test.pdf';



$config = new \Smalot\PdfParser\Config();
$config->setFontSpaceLimit(-60);
$config->setRetainImageContent(true);

$parser = new \Smalot\PdfParser\Parser([], $config);

$parser = new Parser();
$pdf = $parser->parseFile($filename);

echo '<pre>';

echo $pdf->getText();