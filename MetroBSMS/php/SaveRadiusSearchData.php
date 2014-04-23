<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
*		Project			:			BSMS (Bus System Management System)
* 		Date 			:			04/10/2014
* 		File	 		: 			SaveRadiusSearchData.php
* 		Purpose			:			Saving radius search data
* 		Input			:			data in json
* 		Output			:			null
*/

require_once './Models/BusStop.php';

$searchDataJsonString = $_POST['data'];
$type = $_POST['type'];
$searchDataArray = json_decode($searchDataJsonString, true);

foreach ($searchDataArray as $searchData) {
	$searchDataObject = new BusStop();	
	$searchDataObject->saveRadiusSearchData($searchData,$type);
}
echo 1;