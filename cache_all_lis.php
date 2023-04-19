<?php

//testing using the pearls

$pearls = <<<PEARLS


PEARLS;

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
    return  array_filter($allLis);
}

$allpearls = array_merge(explode(',', trim($pearls)), GetAllLis());

$allpearls = array_map(function ($pearl) {
    return strtolower(trim($pearl));
}, $allpearls);





file_put_contents("static/lis.txt", json_encode(array_unique($allpearls)));

print_r(array_unique($allpearls));


