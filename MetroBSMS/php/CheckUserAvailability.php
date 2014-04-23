<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/24/2014
 * 		File	 		: 			CheckUserAvailability.php
 * 		Purpose			:			Checks the availability of the username
 * 		Input			:			userName
 * 		Output			:			True or False
 */


require_once './Models/User.php';

$userName = $_REQUEST['userName'];

$user = new User();
$user->setUserName($userName);

$result = $user->checkUserAvailability();
 if ($result)
 	echo 1;
 else 
 	echo 0;

?>