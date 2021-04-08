<?php

$companySymbol = $_POST["companySymbol"];
$startDate = strtotime($_POST["startDate"]) + 15*3600; //Adjusting time zone
$endDate = strtotime($_POST["endDate"]) + 15*3600;

$url = "https://query1.finance.yahoo.com/v7/finance/download/" . $companySymbol
 		. "?period1=" . $startDate . "&period2=" . $endDate 
 		. "&interval=1d&events=history&includeAdjustedClose=true";
$csv = file_get_contents($url);
$array = array_map("str_getcsv", explode("\n", $csv));
$cleanArray = array();
// $csvResource = "date,price";
// // $arrayFields = array("date", "price"); 

for ($i = 1; $i < count($array); $i++) {
	$cleanArray[] = array(
	"Date" => $array[$i][0],
	"Open" => $array[$i][1]
	// "High" => $array[$i][2],
	// "Low" => $array[$i][3],
	// "Close" => $array[$i][4],
	// "AdjClose" => $array[$i][5],
	// "Volumne" => $array[$i][6]	
	);
	// $csvResource .= $array[$i][0] . "," . $array[$i][1] . "\n";
}

// $outputCSV = fputcsv($cleanArray, $arrayFields, ",");
$json = json_encode($cleanArray); 
// echo $json;
//  echo $csv;
file_put_contents("data.csv", $csv);
echo "finished";

?>
