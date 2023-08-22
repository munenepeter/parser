<?php




 
use Smalot\PdfParser\Parser;

include 'vendor/autoload.php';

$filename = __DIR__ . '/test.pdf';

function pdfTextToHtml($pdfText) {
    $paragraphs = preg_split('/\s*\n\s*\n\s*/', $pdfText);
    $html = '';
    
    foreach ($paragraphs as $paragraph) {
        $html .= '<p>' . nl2br(htmlspecialchars($paragraph)) . '</p>';
    }
    
    return $html;
}

$config = new \Smalot\PdfParser\Config();
$config->setFontSpaceLimit(-80);
$config->setRetainImageContent(true);
$config->setPdfWhitespacesRegex('[\0\t\n\f\r ]');

$parser = new \Smalot\PdfParser\Parser([], $config);
$pdf = $parser->parseFile($filename);

$extractedText = $pdf->getText();
$htmlOutput = pdfTextToHtml($extractedText);

echo trim(str_replace('<br>', '', $htmlOutput));


// include 'vendor/autoload.php';

// $filename = __DIR__ . '/test.pdf';

// function nl2p($string) {
//     return "<p>" . implode("</p><p>", explode("\n", $string)) . "</p>";
// }

// function cleanText($text) {
//     // Remove multiple spaces and line breaks
//     //$text = preg_replace('/\s+/', ' ', $text);

//     return $text;
// }

// $config = new \Smalot\PdfParser\Config();
// $config->setFontSpaceLimit(-80);
// $config->setRetainImageContent(true);
// $config->setPdfWhitespacesRegex('[\0\t\n\f\r ]');

// $parser = new \Smalot\PdfParser\Parser([], $config);


// $pdf = $parser->parseFile($filename);

// $text = cleanText($pdf->getText());

// echo (nl2p($text));

//$parser = new Parser();

// $images = $pdf->getObjectsByType('XObject', 'Image');

// foreach ($images as $image) {
//     echo '<img src="data:image/jpg;base64,' . base64_encode($image->getContent()) . '" />';
// }

//echo '<pre>';