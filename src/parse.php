<?php

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");

include 'functions.php';
//empty response
$messages = [];

// Handle File upload
if (!empty($_FILES) && empty($_POST['text'])) {
    try {
        $text = readUploadedFile($_FILES['files']['tmp_name']);
    } catch (\Exception $e) {
        logger('ERROR: ' . $e->getMessage());
        $messages['text'] = '<p class="p-4 text-red-500 text-sm font-semibold text-center">You have no idea what happened huh? Well so do I. Code:E214</p>';
    }
    // Handle Text input
} elseif (!empty($_POST['text']) && empty($_FILES)) {
    $text = trim($_POST['text']);
    //handle urls
} elseif (!empty($_POST['url']) && empty($_FILES)) {
    try {
        $text = getUrlText(trim($_POST['url']));
    } catch (\Exception $e) {
        logger('ERROR: ' . $e->getMessage());
        $messages['text'] = '<p class="p-4 text-red-500 text-sm font-semibold text-center">You have no idea what happened huh? Well so do I. Code:E214</p>';
    }
}


//check if text is empty
if (!empty($text)) {
    $messages['text'] = $text;
} else {
    logger('ERROR: Couldn\'t get the text!');
    $messages['lis_found'] = "No LI's Found!";
    echo json_encode($messages);
    return;
}

//search for LIS
if (!empty(getLisInText($text))) {
    $messages['lis_found'] =  implode(", ", getLisInText($text));
} else {
    $messages['lis_found'] = "No LI's Found!";
}

//return the object response
echo json_encode($messages, JSON_INVALID_UTF8_IGNORE);

clearstatcache();
exit;
