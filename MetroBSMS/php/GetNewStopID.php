<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
*		Project			:			BSMS (Bus System Management System)
* 		Date 			:			03/17/2014
* 		File	 		: 			GetNewStopID.php
* 		Purpose			:			Get StopID for new/missing stops
* 		Input			:			None
* 		Output			:			Json result with existing MAX stopID
*/


require_once './Models/AssetData.php';

$busDataObject = new AssetData();
$busStopID = $busDataObject->getMaxStopID();

$jsonResultArray = array("data" => $busStopID);

$jsonResult = json_encode($jsonResultArray);
echo $jsonResult;
?>