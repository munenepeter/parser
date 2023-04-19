<?php

use Smalot\PdfParser\Parser;
use LukeMadhanga\DocumentParser;

include '../vendor/autoload.php';

//custom logger
function logger(String $message) {

    $log = date("D, d M Y H:i:s") . ' - ' . $_SERVER['SERVER_NAME'] . ' - ' . $_SERVER['REMOTE_ADDR'] . ' - ' . "$message" . PHP_EOL;

    $logFile =  __DIR__ . "/../static/logs.log";

    $file = fopen($logFile, 'a+');
    fwrite($file, $log);
    fclose($file);
}

function getAllLis() {
    //from cached file
    return json_decode(file_get_contents(__DIR__."/../static/lis.txt"), true);
}


function getLisInText($text) {
    $foundWords = [];

    $chunkSize = 242;
    $searchWordChunks = array_chunk(getAllLis(), $chunkSize);

    // Search for each group of words separately
    foreach ($searchWordChunks as $chunk) {
        $escapedSearchWords = array_map(function ($word) {
            return preg_quote($word, '/');
        }, $chunk);
        $pattern = '/\b(' . implode('|', $escapedSearchWords) . ')\b/i';
        preg_match_all($pattern, $text, $matches);
        //remove duplicate & empty elements
        $foundWords = array_filter(array_unique(array_merge($foundWords, $matches[0])));
    }
    return $foundWords;
}
//parse PDF files
function getPdfText($filename) {
    try {
        $parser = new Parser();
        $pdf = $parser->parseFile($filename);
        $text = $pdf->getText();
        logger('INFO: Trying to parse ' . implode(', ', $pdf->getDetails()));
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
        logger('ERROR: An exception was called ' . $e->getMessage());
        return;
    }
    return $text;
}
//parse word doc
function getWordText($file) {
    try {
        $text = DocumentParser::parseFromFile($file);
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
        logger('ERROR: An exception was called ' . $e->getMessage());
        return;
    }
    return $text;
}
function getExcelText($file) {
    throw new \Exception("Excel format is yet to be supported! E214");
}
function readUploadedFile($file) {
    //pdf
    if (mime_content_type($file) === 'application/pdf') {
        $text = getPdfText($file);
    }
    //word
    if (mime_content_type($file) === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
        $text = getWordText($file);
    }
    //Workbook
    if (mime_content_type($file) === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
        $text = getExcelText($file);
    }
    //plain text
    if (mime_content_type($file) === 'text/plain') {
        $text = file_get_contents($file);
    }

    return $text;
}

function wp_strip_all_tags($string, $remove_breaks = false) {
    $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
    $string = strip_tags($string);

    if ($remove_breaks) {
        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
    }

    return trim($string);
}

function getUrlText($url) {
    $context = stream_context_create(
        [
            "http" => [
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            ]
        ]
    );
    $html = file_get_contents($url, false, $context);

    $parser = new Parser();

    if (str_contains($url, ".pdf")) {
        try {
            $text = $parser->parseContent($html)->getText();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
            logger('ERROR: An exception for URL was thrown ' . $e->getMessage());
            return;
        }
    } else {
        $text = wp_strip_all_tags($html);
    }
    return $text;
}
