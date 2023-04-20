<?php

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

include 'functions.php';
//empty response
$messages = [];




//$pearls = getAllKeywords();
$pearls = [];

if (!empty($pearls)) {
    http_response_code(200);
    $messages['pearls'] =  implode(", ", $pearls);
} else {
    http_response_code(500);
    $messages['message'] = "Something is off and can't access the pearls!";
}

//return the object response
echo json_encode($messages, JSON_INVALID_UTF8_IGNORE);

clearstatcache();
exit;