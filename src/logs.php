<?php

$logFile = __DIR__ . "/../static/logs.log";

function getlogs() {
    $logFile = __DIR__ . "/../static/logs.log";

    if (!file_exists($logFile)) {
        $newLogFile = fopen($logFile, "w") or die("Unable to open file!");

        fclose($newLogFile);

        exit;
    }
    $data = file_get_contents($logFile);

    $logs = explode(PHP_EOL, $data);

    array_pop($logs);

    return array_reverse($logs);
}

function deleteLogs($logFile) {
    echo ("Deleting Logs...");

    logger("Warning", "System: Someone is trying to force delete logs");

    actuallyDeleteLogs($logFile);
}

function actuallyDeleteLogs($logFile) {

    if (!file_exists($logFile)) {
        $newLogFile = fopen($logFile, "w") or die("Unable to open file!");
        echo ("Unable to delete");
        fclose($newLogFile);
        return;
    }

    //delete the file and create a new one
    if (!unlink($logFile)) {
        logger("Debug", "System: Couldn' t delete the logs!");
        echo ("Unable to delete");
    } //recreate the file
    $newLogFile = fopen($logFile, "w") or die("Unable to open file!");
    logger("Info", "System: Logs have been deleted by ");
    fclose($newLogFile);
    echo ("Logs Deleted");
    return;
}

function createlog(string $level, string $msg) {

    $userinfo = json_decode(@file_get_contents(
        'http://ip-api.io/json/' . $_SERVER['REMOTE_ADDR'],
        false,
        stream_context_create([
            'http' => [
                'ignore_errors' => true,
            ],
        ])
    ));
    $log = json_encode([
        'level' => $level,
        'time' => date("D, d M Y H:i:s"),
        "more" => [
            "method" => $_SERVER["REQUEST_METHOD"],
            "uri" => '/' . $_SERVER['REQUEST_URI'],
            "remote_addr" => $_SERVER['REMOTE_ADDR'],
            "region" => $userinfo->region_name ?? "N/A",
            "country" => $userinfo->country_name ?? "N/A",
            "city" => $userinfo->city ?? "N/A",
            "provider" => $userinfo->organisation ?? "N/A",
            "time_zone" => $userinfo->time_zone ?? "N/A",
            "agent" => $_SERVER['HTTP_USER_AGENT']
        ],
        "description" => nl2br($msg)
    ]) . PHP_EOL;

    $logFile = __DIR__ . "/../static/logs.log";


    if (!file_exists($logFile)) {
        touch($logFile);
        chmod($logFile, 0644);
    }


    $file = fopen($logFile, 'a+', 1);
    fwrite($file, $log);
    fclose($file);
}
