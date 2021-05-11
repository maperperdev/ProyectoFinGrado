<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataFromYahooController extends Controller
{

	public function getPriceToday(Request $request)
	{
		$companySymbol = $request->input("companySymbol");
		$url = "https://query1.finance.yahoo.com/v7/finance/download/" . $companySymbol;

		$csv = file_get_contents($url);
		$array = array_map("str_getcsv", explode("\n", $csv));
		$cleanArray = array();

		for ($i = 1; $i < count($array); $i++) {
			$cleanArray[] = array(
				"Date" => $array[$i][0],
				"Open" => $array[$i][1]
			);
		}
		return response()->json(array("price" => $cleanArray[0]["Open"]));
	}

	public function getDataForChart(Request $request)
	{
		$companySymbol = $request->input("companySymbol");
		$startDate = strtotime($request->input("startDate")) + 15 * 3600; //Adjusting time zone
		$endDate = strtotime($request->input("endDate")) + 15 * 3600;

		$url = "https://query1.finance.yahoo.com/v7/finance/download/" . $companySymbol
			. "?period1=" . $startDate . "&period2=" . $endDate
			. "&interval=1d&events=history&includeAdjustedClose=true";
		$csv = file_get_contents($url);
		$array = array_map("str_getcsv", explode("\n", $csv));
		$cleanArray = array();

		for ($i = 1; $i < count($array); $i++) {
			$cleanArray[] = array(
				"Date" => $array[$i][0],
				"Open" => $array[$i][1]
			);
		}
		return response()->json($cleanArray);
	}
}
