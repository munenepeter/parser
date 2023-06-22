<?php

//testing using the pearls

$pearls = file_get_contents("static/pearls.txt");

function getAllLis() {
    //from db
    $databaseLis = json_decode(file_get_contents("static/lis-names.json"));

    $allLis = [];

    foreach ($databaseLis as $databaseLi) {
        $allLis[] = $databaseLi->name;

        $abbrs = explode(',', trim($databaseLi->abbr));

        foreach ($abbrs as $abbr) {
            $allLis[] = trim($abbr);
        }
    }
    return  array_filter($allLis);
}

$allpearls = array_merge(explode(',', trim($pearls)), getAllLis());

$allpearls = array_map(function ($pearl) {
    return strtolower(trim($pearl));
}, $allpearls);





file_put_contents("static/keywords.txt", json_encode(array_unique($allpearls)));


echo "Keywords cached successfully";



