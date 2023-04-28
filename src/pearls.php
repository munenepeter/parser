<?php

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

include 'functions.php';

$pearls = getAllKeywords();

if (!empty($pearls)) {
    http_response_code(200);
    echo json_encode(['pearls' => $pearls], JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(500);
    echo json_encode(['message' => "Something is off and can't access the pearls!"]);
}

exit;
