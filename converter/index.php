<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="title" content="Converter">
    <meta name="description" content="A Simple way of parsing pdf, docx, text or rtf files so as to identify certain keywords using pearl">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Peter Munene">
    <title>Document Converter</title>
    <link rel="shortcut icon" href="static/imgs/translate.svg" type="image/svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-gray-50">

    <nav class="px-2 sm:px-4 py-2 fixed w-full  top-0 left-0 backdrop-blur-3xl shadow-sm bg-gradient-to-r from-rose-50 to-white">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <div class="flex items-center space-x-2">
                <div class="h-8 w-8 bg-orange-200 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full p-1 text-orange-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span style="font-size: 10px;" class="text-purple-900">Hotline 24/7</span>
                    <span class="text-sm text-purple-900 font-semibold">developers@chungu.co.ke</span>
                </div>

            </div>
            <button type="button" class="inline-flex items-center p-2 text-sm text-purple-900 rounded-lg md:hidden hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-200 dark:text-purple-400 dark:hover:bg-purple-700 dark:focus:ring-purple-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                <ul class="flex flex-col p-2 mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-semibold ">
                    <li>
                        <a href="/" class="block py-2 pl-3 pr-4 text-purple-700 md:hover:text-orange-700 md:p-0 ">Parser</a>
                    </li>
                    <li>
                        <a href="https://dev.chungu.co.ke/projects" class="block py-2 pl-3 pr-4  md:p-0 text-purple-700 md:hover:text-orange-700">Projects</a>
                    </li>

                    <li>
                        <a href="https://dev.chungu.co.ke/" class="block py-2 pl-3 pr-4 text-purple-700 md:hover:text-orange-700 md:p-0 ">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-purple-700 md:hover:text-orange-700 md:p-0 ">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="pt-4 pb-10 lg:pt-16 mt-10">
        <section class="flex justify-between px-2 mx-auto max-w-screen-2xl ">
            <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-purple dark:format-invert">
                <header class="mb-4 border-b border-orange-200 dark:border-orange-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li class="mr-2" role="presentation"> <button class="inline-block p-4 border-b-2 rounded-t-lg text-purple-900" id="document-tab" data-tabs-target="#document" type="button" role="tab" aria-controls="document" aria-selected="false">Converter(excel)</button> </li>
                    </ul>
                </header>
                <section id="myTabContent">
                    <div class="p-2 rounded-lg bg-rose-50 dark:bg-gray-800" id="document" role="tabpanel" aria-labelledby="document-tab">
                        <br>
                        <p class="text-red-600 text-lg text-center italic">This feature is in active development, please try again later</p>
                        <br>
                        <p id="doc-label" class="text-lg text-center font-medium text-gray-900 dark:text-white">Welcome to Document Converter</p> <label id="doc-label-guide" class="block mb-2 text-sm text-center text-gray-500 dark:text-gray-400" for="file_input" data-js-label>Select document to convert</label>
                        <form method="post" action="/src/parse.php" id="doc-form" enctype="multipart/form-data" class=" flex flex-col justify-center">
                            <div class="flex flex-row justify-center items-center">
                                <input disabled class="mr-2 block w-3/4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type='file' name="files" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" />
                                <button name="submitpdf" type="disabled" id="submitpdf" class="focus:outline-none text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Convert</button>
                            </div>
                            <div class="flex items-center mb-4">
                                <input disabled id="excel-html" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="excel-html" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Excel-HTML</label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input disabled id="excel-json" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="excel-json" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Excel-JSON</label>
                            </div>
                        </form>
                        <center> <img style="display:none;" id="loader" src="static/imgs/loader.gif" alt="" width="150" height="150" srcset=""></p>
                        </center>
                        <section id="doc-content" style="display:none;" class="mt-4 p-2 rounded-lg bg-white">
                            <div id="content" class="p-2 overflow-y-auto h-80"></div>
                        </section>
                        <section class="mt-2 flex justify-between">
                            <div class="hidden bg-gray-50 rounded-lg">
                                <p class="text-sm"></p>
                            </div>
                            <div style="display:none;" id="extra" class="flex flex-col p-4 space-x-4 rounded-lg items-center">
                                <div class="w-11/12 bg-white p-1 text-xs" id="keywords_plate">
                                </div>

                                <button id="clear" type="button" class="mt-1 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Reset</button>
                            </div>

                        </section>
                    </div>

                </section>
            </article>
        </section>
    </main>
    <div class="border-t bg-gray-100 left-50 w-full  bottom-0" style="position: fixed;  left: 50%; transform: translate(-50%, 0);">
        <div class="text-gray-900 text-sm text-center">
            <div class="my-5 text-center">© 2020 - 2023 All rights reserved | <a class="hover:underline" href="https://dev.chungu.co.ke/">Chungu Developers</a> </div>
        </div>
    </div>
    <script src="static/js/index.js"></script>
</body>

</html>






<?php

include_once 'SimpleXLSX.php';
echo '<pre>';

// open
$filename = 'test3.xlsx';

$xlsx = Test\SimpleXLSX::parseFile($filename, $debug = false);

// simple
// $xlsx->rows($worksheetIndex = 0, $limit = 0): array
// $xlsx->readRows($worksheetIndex = 0, $limit = 0): Generator - helps read huge xlsx
//print $xlsx->toHTMLEx(1);
// extended
// $xlsx->rowsEx($worksheetIndex = 0, $limit = 0): array
// $xlsx->readRowsEx($worksheetIndex = 0, $limit = 0): Generator - helps read huge xlsx with styles
// $xlsx->toHTMLEx($worksheetIndex = 0, $limit = 0): string
// meta
// $xlsx->dimension($worksheetIndex):array [num_cols, num_rows]
// $xlsx->sheetsCount():int
// $xlsx->sheetNames():array
// $xlsx->sheetName($worksheetIndex):string
// $xlsx->sheetMeta($worksheetIndex = null):array sheets metadata (null = all sheets)
// $xlsx->isHiddenSheet($worksheetIndex):bool

//print $xlsx->getStyles();

// foreach ($xlsx->sheetNames() as $sheet) {
//     print $sheet;
// }

function wp_strip_all_tags($string, $remove_breaks = false) {
    $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
    $string = strip_tags($string);

    if ($remove_breaks) {
        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
    }

    return trim($string);
}

// $html = '';
// for ($i = 0; $i < count($xlsx->sheetNames()); $i++) {
//     $html .=  $xlsx->sheetName($i) . wp_strip_all_tags($xlsx->toHTMLEx($i));
// }

// file_put_contents('test14.html', $html);

?>