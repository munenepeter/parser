<?php



$text = "Lorem ipsum SSM, dolor sit amet consectetur adipisicing elit. , Regulation (EU) No 1024/2013, consectetur adipisicing Single Supervisory Mechanism Neque perferendis 2015/849 aut crr vero a CA 2001  2022/2554 animi at voluptate nulla recusandae dignissimos 1024/2013 dolorum.";

$keywords = json_decode(file_get_contents("static/lis.txt"), true);

$dataset = json_decode(file_get_contents("lis-names.json"), true);

// $found_keywords_in_text = [];
// $found_names_in_text = [];

// // Step 1: Search for keywords in text
// foreach ($keywords as $keyword) {
//     if (stripos($text, $keyword) !== false) {
//         $found_keywords_in_text[] = $keyword;
//     }
// }
// print_r($found_keywords_in_text);
// // Step 2: Compare found keywords with dataset

// foreach ($dataset as $data) {
//     $keywords = explode(", ", $data["abbr"]);
//     foreach ($found_keywords_in_text as $found) {
//         foreach ($keywords as $kw) {
//             if (strcasecmp($found, $kw) == 0) {
//                 $found_names_in_text[] = $data['name'];
//             }
//         }
//     }
// }

// print_r($found_names_in_text);


echo "-==============================================".PHP_EOL;
echo "Functions".PHP_EOL;
echo "-==============================================".PHP_EOL;

function getKeywordsInText($text, $keywords) {

    $foundWords = [];

    $chunkSize = 240;
    $searchWordChunks = array_chunk($keywords, $chunkSize);

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




function getLisinText($keywords_found_in_text, $dataset) {
    $found_names_in_text = [];

    // Compare found keywords with dataset
    foreach ($dataset as $data) {
        $keywords = explode(", ", $data["abbr"]);
        foreach ($keywords_found_in_text as $found) {
            foreach ($keywords as $kw) {
                if (strcasecmp($found, $kw) == 0) {
                    $found_names_in_text[] = $data['name'];
                }
            }
        }
    }
  
    return $found_names_in_text;
}






print_r(getKeywordsInText($text, $keywords));

echo "LIS".PHP_EOL;

print_r(getLisinText(getKeywordsInText($text, $keywords), $dataset));


// function search_text_for_keywords($text, $keywords, $dataset) {
//     $found_keywords_in_text = [];
//     $found_names_in_text = [];

//     //Search for keywords in text
//     foreach ($keywords as $keyword) {
//         if (stripos($text, $keyword) !== false) {
//             $found_keywords_in_text[] = $keyword;
//         }
//     }

//     // Compare found keywords with dataset
//     foreach ($dataset as $data) {
//         $keywords = explode(", ", $data["abbr"]);
//         foreach ($found_keywords_in_text as $found) {
//             foreach ($keywords as $kw) {
//                 if (strcasecmp($found, $kw) == 0) {
//                     $found_names_in_text[] = $data['name'];
//                 }
//             }
//         }
//     }

//     $found = [];
//     $found['keywords'] = $found_keywords_in_text;
//     $found['lis'] = $found_names_in_text;

//     return $found;
// }