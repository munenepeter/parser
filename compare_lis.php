<?php


// // Define an associative array of names and keywords
// $nameKeywords = array(
//     "Single Supervisory Mechanism (SSM)" => array("1024/2013", "Regulation (EU) No 1024/2013", "SSM", "Single Supervisory Mechanism"),
//     "Another Name" => array("some", "other", "keywords"),
//     // Add more names and their corresponding keywords as needed
// );

// // Define the text to search
// $text = "Lorem ipsum SSM, dolor sit amet some consectetur adipisicing elit. , Regulation (EU) No 1024/2013, consectetur adipisicing Single Supervisory Mechanism Neque perferendis aut vero a animi at voluptate nulla recusandae dignissimos 1024/2013 dolorum.";

// // Find all the keywords in the text
// $keywords = array();
// foreach ($nameKeywords as $name => $nameKeywordsArray) {
//     foreach ($nameKeywordsArray as $keyword) {
//         if (stripos($text, $keyword) !== false) {
//             $keywords[] = $keyword;
//         }
//     }
// }

// // Find the name corresponding to the matched keywords
// foreach ($nameKeywords as $name => $nameKeywordsArray) {
//     if (count(array_intersect($nameKeywordsArray, $keywords)) == count($keywords)) {
//         echo $name;
//         break;
//     }
// }



// $text = "Lorem ipsum SSM, dolor sit amet consectetur adipisicing elit. , Regulation (EU) No 1024/2013, consectetur adipisicing Single Supervisory Mechanism Neque perferendis aut vero a animi at voluptate SRD II nulla recusandae dignissimos 1024/2013 dolorum.";

// $dataset = [
//     "Single Supervisory Mechanism (SSM)" => "1024/2013, Regulation (EU) No 1024/2013, SSM, Single Supervisory Mechanism",
//     "Shareholder Rights Directive II (SRD II)" => "Directive (EU) 2017/828, Directive (EU) 2017/828, SRD II",
//     "E-money Directive"	=> "Directive 2009/110/EC, EMD, Electronic Money Directive"
// ];

// $keywords = "1024/2013, Regulation (EU) No 1024/2013, SSM, Single Supervisory Mechanism";

// $names = [];
// foreach ($dataset as $name => $keywordsString) {
//     $keywordsArr = explode(",", $keywordsString);
//     foreach ($keywordsArr as $keyword) {
//         if (stripos($text, trim($keyword)) !== false) {
//             $names[] = $name;
//             break;
//         }
//     }
// }

// if (count($names) > 0) {
//     $nameString = implode(", ", $names);
//     echo "Matched name(s): " . $nameString;
// } else {
//     echo "No match found.";
// }




$text = "Lorem ipsum SSM, dolor sit amet consectetur adipisicing elit. , Regulation (EU) No 1024/2013, consectetur adipisicing Single Supervisory Mechanism Neque perferendis 2015/849 aut crr vero a CA 2001 animi at voluptate nulla recusandae dignissimos 1024/2013 dolorum.";

$keywords = json_decode(file_get_contents("static/lis.txt"), true);

$dataset = json_decode(file_get_contents("lis-names.json"), true);

$found_keywords_in_text = [];
$found_names_in_text = [];

// Step 1: Search for keywords in text
foreach ($keywords as $keyword) {
    if (stripos($text, $keyword) !== false) {
        $found_keywords_in_text[] = $keyword;
    }
}
print_r($found_keywords_in_text);
// Step 2: Compare found keywords with dataset

foreach ($dataset as $data) {
    $keywords = explode(", ", $data["abbr"]);
    foreach ($found_keywords_in_text as $found) {
        foreach ($keywords as $kw) {
            if (strcasecmp($found, $kw) == 0) {
                $found_names_in_text[] = $data['name'];
            }
        }
    }
}

// Step 3: Print found names
print_r($found_names_in_text);


