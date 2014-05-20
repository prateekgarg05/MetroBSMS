<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			05/04/2014
 * 		File	 		: 			CheckImages.php
 * 		Purpose			:			Checking whether images trying to upload are already present
 * 		Input			:			JSON string of all uploading images names
 * 		Output			:			JSON string of images which are already present
 */

require_once './Models/AssetData.php';

$imageDataJsonString = $_REQUEST['imageData'];
$imagetDataArray = json_decode($imageDataJsonString, true);
$output = "";

foreach ($imagetDataArray as $imageData) {
	$imageDataObject = new AssetData();	
	$result = $imageDataObject->IsImageDataPresent($imageData);
	if ($result != "")
	{
		$pos = explode("_", $result);	
		$output .= $pos[1] . " was already used in the other bus stop images.<br />";
	}
}
if ($output != "")
	$output .= "Please choose the Images again";
echo $output;
?>