<?php

use Smalot\PdfParser\Parser;

include 'vendor/autoload.php';

$filename = __DIR__ . '/test.pdf';

function nl2p($string) {
    return trim("<p>" . implode("</p><p>", explode("\n", trim($string, " "))) . "</p>", " ");
}

function pdfTextToHtml($pdfText) {
    $paragraphs = preg_split('/\s*\n\s*\n\s*/', trim($pdfText," "));
    $html = '';
    
    foreach ($paragraphs as $paragraph) {
        $html .= '<p>' . nl2p(htmlspecialchars($paragraph)) . '</p>';
    }
    
   return "<div>{$html}</div>";
}


function combineParagraphs($input) {
    // Remove empty <p></p> tags
    $input = preg_replace('/<p><\/p>/', '', $input);

    // Suppress libxml errors
    libxml_use_internal_errors(true);

    // Parse the input HTML
    $dom = new DOMDocument();
    $dom->loadHTML($input);

    // Restore libxml error handling
    libxml_use_internal_errors(false);
    

    $paragraphs = $dom->getElementsByTagName('p');
    $combinedParagraphs = [];

    $currentParagraph = null;

    foreach ($paragraphs as $index => $paragraph) {
        $text = trim($paragraph->nodeValue);

        // Remove extra spaces between letters
        $text = preg_replace('/\s+/', ' ', $text);

        if ($currentParagraph === null) {
            $currentParagraph = $text;
        } else {
            $nextParagraphIndex = $index + 1;
            $nextParagraphStartsWithNumber = ($nextParagraphIndex < $paragraphs->length) && preg_match('/^\s*\d/', trim($paragraphs[$nextParagraphIndex]->nodeValue));

            if (preg_match('/^\s*\d/', $text) || $nextParagraphStartsWithNumber) {
                $combinedParagraphs[] = '<p>' . $currentParagraph . '</p>';
                $currentParagraph = $text;
            } else {
                $currentParagraph .= ' ' . $text;
            }
        }
    }

    if ($currentParagraph !== null) {
        $combinedParagraphs[] = '<p>' . $currentParagraph . '</p>';
    }

    return implode("\n\n", $combinedParagraphs);
}

function convertHeadings($input) {
    return preg_replace(
        '/<p>(\d+\..*?|([A-Z\s]+))<\/p>/',
        '<h5>$1</h5>',
        $input
    );
 
}



$config = new \Smalot\PdfParser\Config();
$config->setFontSpaceLimit(-80);
$config->setRetainImageContent(true);
$config->setPdfWhitespacesRegex('[\0\t\n\f\r ]');

$parser = new \Smalot\PdfParser\Parser([], $config);
$pdf = $parser->parseFile($filename);

$extractedText = $pdf->getText();
$htmlOutput = pdfTextToHtml($extractedText);

//$htmlOutput = convertHeadings($htmlOutput);

//echo '<pre>';
echo combineParagraphs($htmlOutput);

 
 
 

//$parser = new Parser();

// $images = $pdf->getObjectsByType('XObject', 'Image');

// foreach ($images as $image) {
//     echo '<img src="data:image/jpg;base64,' . base64_encode($image->getContent()) . '" />';
// }

 