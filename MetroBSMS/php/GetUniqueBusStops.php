<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			04/03/2014
 * 		File	 		: 			GetUniqueBusStops.php
 * 		Purpose			:			Retrieving locations of busstops to populate the map on the front end
 * 		Input			:			null
 * 		Output			:			Json result with bust stop information
 */


require_once './Models/BusStop.php';

$busStopObject = new BusStop();
$dataArray = array();

$busStopArray = $busStopObject->getUniqueBusStops();
foreach ($busStopArray as $busStop) {
	array_push($dataArray, $busStop);
}
$jsonResultArray = array("data" => $dataArray);

$jsonResult = json_encode($jsonResultArray);
echo $jsonResult;
?>