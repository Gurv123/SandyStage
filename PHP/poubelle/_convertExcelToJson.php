<?php
/*require_once "PHPExcel.php";
$excelReader = PHPExcel_IOFactory::createReaderForFile($file);
$excelObj = $excelReader->load($file);

$sheetCount = $excelObj->getSheetCount();
$sheetNames = $excelObj->getSheetNames();

$lastRow = $worksheet->getHighestRow();

$lastCol = $worksheet->getHighestColumn();

for ($col = 'A'; $col <= $lastCol; $col++) {
    // code
}*/

if (isset($_FILES["file"])) {
	$file = "files/".basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $file);
    
    require_once "PHPExcel.php";
    $excelReader = PHPExcel_IOFactory::createReaderForFile($file);
    $excelObj = $excelReader->load($file);
    $sheetCount = $excelObj->getSheetCount();
    $sheetNames = $excelObj->getSheetNames();
    
    $result = [];
    for ($sheet = 0; $sheet < $sheetCount; $sheet++) {
        $worksheet = $excelObj->getSheet($sheet);
        $lastRow = $worksheet->getHighestRow();
        $lastCol = $worksheet->getHighestColumn();
        
        $data = [];
        for ($row = 2; $row <= $lastRow; $row++) {
            $output = Array();
            for ($col = 'A'; $col <= $lastCol; $col++) {
                if ($worksheet->getCell($col.'1')->getValue() !== null && $worksheet->getCell($col.'1')->getValue() !== "") {
                    $output[$worksheet->getCell($col.'1')->getValue()] = $worksheet->getCell($col.$row)->getValue();
                }
            }
            $data[] = $output;
        }
        $result[$sheetNames[$sheet]] = $data;
    }
    echo json_encode($result);
}
else
{
	echo "hello !";
}
?>