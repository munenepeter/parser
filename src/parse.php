<?php

// set the response headers
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

// include required functions
include 'functions.php';

// initialize the response array
$messages = [];

// Handle File upload
if (!empty($_FILES) && empty($_POST['text'])) {
    try {
        // read the uploaded file
        $text = readUploadedFile($_FILES['files']['tmp_name']);
    } catch (\Exception $e) {
        // log any errors and set an error message for the user
        logger('ERROR: ' . $e->getMessage());
        $messages['text'] = '<p class="p-4 text-red-500 text-sm font-semibold text-center">You have no idea what happened huh? Well so do I. Code:E214</p>';
    }
}
// Handle Text input
elseif (!empty($_POST['text']) && empty($_FILES)) {
    // get the text input
    $text = trim($_POST['text']);
}
//handle urls
elseif (!empty($_POST['url']) && empty($_FILES)) {
    try {
        // get the text from the URL
        $text = getUrlText(trim($_POST['url']));
    } catch (\Exception $e) {
        // log any errors and set an error message for the user
        logger('ERROR: ' . $e->getMessage());
        $messages['text'] = '<p class="p-4 text-red-500 text-sm font-semibold text-center">You have no idea what happened huh? Well so do I. Code:E214</p>';
    }
}

//check if text is empty
if (empty($text)) {
    logger('ERROR: Couldn\'t get the text!');
    $messages['lis_found'] = "No LI's Found!";
    echo json_encode($messages);
    return;
}

$messages['text'] =  $text;

// get the keywords and LISs in the text
$keywords_found = get_keywords_in_text($text);
$lis_found = get_lis_in_text($keywords_found);

//search for LIS
if (!empty($keywords_found)) {
    $messages['keywords_found'] =  implode(", ", $keywords_found);
    $messages['lis_found'] =  empty($lis_found) ? "Seems like there are no LIs in the file" : implode(", ", $lis_found);
} else {
    $messages['lis_found'] = "No LI's Found!";
}

// return the JSON response
echo json_encode($messages, JSON_INVALID_UTF8_IGNORE);

// clear any cached file status data
clearstatcache();
exit;
