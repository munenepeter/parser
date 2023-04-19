<?php



function getAllLis() {
    //from db
    $databaseLis = json_decode(file_get_contents("https://munenepeter.github.io/my-file-tracker/data/datas.json"));

    $allLis = [];

    foreach ($databaseLis as $databaseLi) {
        $allLis[] = $databaseLi->name;

        $abbrs = explode(',', trim($databaseLi->abbr));

        foreach ($abbrs as $abbr) {
            $allLis[] = trim($abbr);
        }
    }
    return  $allLis;
}