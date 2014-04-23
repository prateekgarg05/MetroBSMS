<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
*		Project			:			BSMS (Bus System Management System)
* 		Date 			:			04/10/2014
* 		File	 		: 			GetRadiusSearchData.php
* 		Purpose			:			Retrieving radius search data
* 		Input			:			radius
* 		Output			:			Json result with radius search data
*/


require_once './Models/BusStop.php';

$radiusDataObject = new BusStop();
$dataArray = array();

if (isset($_REQUEST['radius'])) {
	$radius = $_REQUEST['radius'];
}
else {
	$radius = -1;
}
$type = $_REQUEST['type'];

$radiusDataArray = $radiusDataObject->getRadiusSearchData($radius,$type);
if($radiusDataArray)
{
	foreach ($radiusDataArray as $radiusData) {
		array_push($dataArray, $radiusData);
	}
}
$jsonResultArray = array("data" => $dataArray);

$jsonResult = json_encode($jsonResultArray);
echo $jsonResult;
?>