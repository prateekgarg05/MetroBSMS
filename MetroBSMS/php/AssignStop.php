<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/14/2014
 * 		File	 		: 			AssignStop.php
 * 		Purpose			:			Assign the stop to a user
 * 		Input			:			userName, stopID
 * 		Output			:			True or False
 */

require_once './Models/User.php';

$userName = $_REQUEST['userName'];
$stopID = $_REQUEST['stopID'];

$user = new User();
$user->setUserName($userName);

$result = $user->assignStopToUser($stopID);

if ($result)
	echo 1;
else
	echo 0;

?>