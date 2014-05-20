<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			02/11/2014
 * 		File	 		: 			SaveAssetData.php
 * 		Purpose			:			Managin JSON manipulations in the application
 * 		Input			:			JSON string of all the information related to an asset
 * 		Output			:			Insert the data into the MySQL database
 */

require_once './Models/AssetData.php';

//$assetDataJsonString = "{\"data\":[{\"assettype_id\":\"1\",\"informationtype_id\":\"2\",\"fieldtype_id\":\"1\",\"asset_id\":\"2\",\"value\":\"tex/or value id\",\"domainvalue_id\":\"2\",\"enteredby_user_id\":\"1\"},{\"assettype_id\":\"1\",\"informationtype_id\":\"2\",\"fieldtype_id\":\"1\",\"asset_id\":\"2\",\"value\":\"tex/orvalueid\",\"domainvalue_id\":\"2\",\"enteredby_user_id\":\"1\"}]}";
$assetDataJsonString = $_REQUEST['busstopData'];
$assetDataArray = json_decode($assetDataJsonString, true);

$stopID = $assetDataArray['data'][0]['asset_id'];
$assetDataObj = new AssetData();
$result = $assetDataObj->CheckBusStopDataPresent($stopID);

foreach ($assetDataArray['data'] as $assetData) {
	$assetDataObject = new AssetData();
	$assetDataObject->createObjectFromArray($assetData);
	$assetDataObject->saveToDB();
}

$busDataObject = new AssetData();
$busDataObject->createObjectFromArray($assetDataArray['data'][0]);
$busDataObject->updateBusStopStatus();

?>