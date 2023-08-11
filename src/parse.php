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
        logger('Error',  $e->getMessage());
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
        logger('Error', '' . $e->getMessage());
        $messages['text'] = '<p class="p-4 text-red-500 text-sm font-semibold text-center">You have no idea what happened huh? Well so do I. Code:E214</p>';
    }
}

//check if text is empty
if (empty($text)) {
    logger('Error', 'Couldn\'t get the text!');
    $messages['keywords_found'] = 'Sorry, there was an error, try contacting the developer developers@chungu.co.ke';
    $messages['lis_found'] =  'An error has occured';
    $messages['text'] = '<p class="p-4 text-red-500 text-md font-semibold text-center">Something happened while trying to get the text, please try using the \'text\' parser</p>';
    echo json_encode($messages);
    return;
}

$messages['text'] =  $text;

// get the keywords and LISs in the text
$keywords_found = get_keywords_in_text($text);
$lis_found = get_lis_in_text($keywords_found);

$colored_lis = [];
foreach ($lis_found as $li) {

   $href = http_build_query([
    'source' => 'parser',
    'resource' => 'legislative_initiatives',
   'searchString' => $li
   ]);
 $colored_lis[] = '<a target="_blank" class="hover:underline"
           href="https://munenepeter.github.io/legislative-initiatives/?' . $href . '"
           style="color:' . getRandColor() . '">' .
           $li . '</a>';
}



$colored_keywords = [];
foreach ($keywords_found as $keyword_found) {

$href = http_build_query([
'source' => 'parser',
'resource' => 'keywords',
'searchString' => $keyword_found
]);
$colored_keywords[] = '<a target="_blank" class="hover:underline" href="https://munenepeter.github.io/legislative-initiatives/?' . $href . '"
    style="color:' . getRandColor() . '">' .
    strtolower($keyword_found) . '</a>';
}

//search for LIS
if (!empty($keywords_found)) {
    $messages['keywords_found'] = implode(", ", array_unique($colored_keywords));
    $messages['lis_found'] =  empty($lis_found) ? "Seems like there are no LIs in the file" : implode(", ", $colored_lis);
} else {
    $messages['keywords_found'] =  "No keywords found";
    $messages['lis_found'] = "No LI's Found!";
}

// return the JSON response
echo json_encode($messages, JSON_INVALID_UTF8_IGNORE);

// clear any cached file status data
clearstatcache();
exit;
