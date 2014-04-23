<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/05/2014
 * 		File	 		: 			GetBusStops.php
 * 		Purpose			:			Retrieving locations of busstops to populate the map on the front end
 * 		Input			:			lineNumber (optional) - to retrieve bus stop for a particular line
 * 		Output			:			Json result with bust stop information
 */


require_once './Models/BusStop.php';

$busStopObject = new BusStop();
$dataArray = array();
if (isset($_REQUEST['lineNumber'])) {
	$lineNumber = $_REQUEST['lineNumber'];
}
else {
	$lineNumber = -1;
}
$busStopArray = $busStopObject->getAllBusStopsForLine($lineNumber);
foreach ($busStopArray as $busStop) {
	array_push($dataArray, $busStop);
}
$jsonResultArray = array("data" => $dataArray);

$jsonResult = json_encode($jsonResultArray);
echo $jsonResult;
?>