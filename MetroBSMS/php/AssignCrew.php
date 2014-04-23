<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/24/2014
 * 		File	 		: 			CheckCrewAvailability.php
 * 		Purpose			:			Checks the availability of the crewname
 * 		Input			:			crewName
 * 		Output			:			True or False
 */


require_once './Models/User.php';

$crewName = $_REQUEST['crewName'];
$userName = $_REQUEST['userName'];

$user = new User();
$user->setUserName($userName);
$user->setDateModified(date("Y-m-d H:i:s", time()));

$result = $user->assignCrewToUser($crewName);
 if ($result)
 	echo 1;
 else 
 	echo 0;

?>