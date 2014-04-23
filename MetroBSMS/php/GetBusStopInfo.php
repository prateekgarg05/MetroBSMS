<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/14/2014
 * 		File	 		: 			GetBusStopInfo.php
 * 		Purpose			:			Retrieve Information about a BusStop
 * 		Input			:			stopID
 * 		Output			:			Json result with bust stop information
 */


require_once './Models/BusStop.php';

$busStopObject = new BusStop();
$dataArray = array();
if (isset($_REQUEST['stopID'])) {
	$stopID = $_REQUEST['stopID'];
}
else {
	$stopID = -1;
}
$busStop = $busStopObject->getBusStopInformation($stopID);

$jsonResultArray = array("data" => $busStop);

$jsonResult = json_encode($jsonResultArray);
echo $jsonResult;
?>