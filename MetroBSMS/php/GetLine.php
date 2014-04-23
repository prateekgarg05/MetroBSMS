<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/28/2014
 * 		File	 		: 			GetLine.php
 * 		Purpose			:			Gets the list of line numbers
 * 		Input			:			Null
 * 		Output			:			Json array of line numbers
 */


require_once './Models/BusStop.php';

$busStopObject = new BusStop();

$lineNumbers = $busStopObject->getLineNumbers();

$jsonResultArray = array("data" => $lineNumbers);

$jsonResult = json_encode($jsonResultArray);
echo $jsonResult;
?>