<?php

use Smalot\PdfParser\Parser;

include 'vendor/autoload.php';

$filename = __DIR__ . '/test.pdf';

function nl2p($string) {
    return "<p>" . implode("</p><p>", explode("\n", $string)) . "</p>";
}

$config = new \Smalot\PdfParser\Config();
$config->setFontSpaceLimit(-80);
$config->setRetainImageContent(true);
$config->setPdfWhitespacesRegex('[\0\t\n\f\r ]');

$parser = new \Smalot\PdfParser\Parser([], $config);


$pdf = $parser->parseFile($filename);



print_r(nl2p($pdf->getText()));

//$parser = new Parser();

// $images = $pdf->getObjectsByType('XObject', 'Image');

// foreach ($images as $image) {
//     echo '<img src="data:image/jpg;base64,' . base64_encode($image->getContent()) . '" />';
// }

//echo '<pre>';