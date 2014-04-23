<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/24/2014
 * 		File	 		: 			GetUser.php
 * 		Purpose			:			Gets the list of users
 * 		Input			:			Null
 * 		Output			:			json array of usernames
 */


require_once './Models/User.php';

$user = new User();

if (isset($_REQUEST['crewName'])) {
	$crewName = $_REQUEST['crewName'];
}
else {
	$crewName = '';
}

$userNames = $user->getUsernames($crewName);

$jsonResultArray = array("data" => $userNames);

$jsonResult = json_encode($jsonResultArray);
echo $jsonResult;

?>