<?php

use Smalot\PdfParser\Parser;

include 'vendor/autoload.php';

$filename = __DIR__ . '/test.pdf';



$config = new \Smalot\PdfParser\Config();
$config->setFontSpaceLimit(01);
$config->setRetainImageContent(true);
$config->setPdfWhitespacesRegex('[\0\t\n\f\r ]');

$parser = new \Smalot\PdfParser\Parser([], $config);

$parser = new Parser();
$pdf = $parser->parseFile($filename);

$images = $pdf->getObjectsByType('XObject', 'Image');

foreach ($images as $image) {
    echo '<img src="data:image/jpg;base64,' . base64_encode($image->getContent()) . '" />';
}

echo '<pre>';

print_r($pdf->getText());

