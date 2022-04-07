<?php

use SimpleExcel\SimpleExcel;

require_once('./faisalman-simple-excel-php-ea5326d/src/SimpleExcel/SimpleExcel.php'); // load the main class file (if you're not using autoloader)

echo $_POST['action'];
$excel = new SimpleExcel('csv');                    // instantiate new object (will automatically construct the parser & writer type as XML)

$excel->parser->loadFile('test.csv');            // load an XML file from server to be parsed

/*$foo = $excel->parser->getField();                  // get complete array of the table
$bar = $excel->parser->getRow(3);                   // get specific array from the specified row (3rd row)
$baz = $excel->parser->getColumn(4);                // get specific array from the specified column (4th row)
$qux = $excel->parser->getCell(2,1);                // get specific data from the specified cell (2nd row in 1st column)

echo '<pre>';
print_r($foo);                                      // echo the array
echo '</pre>';*/

$excel->convertTo('json');
$excel->writer->saveFile('test');



?>