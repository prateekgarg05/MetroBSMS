<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/05/2014
 * 		File	 		: 			Login.php
 * 		Purpose			:			Authenticates the user
 * 		Input			:			userName and password
 * 		Output			:			Json result with bust stop information
 */


require_once './Models/User.php';

$userName = $_REQUEST['userName'];
$password = $_REQUEST['password'];

$user = new User();
$user->setUserName($userName);
$user->setPassword($password);
$result = $user->authenticateUser();
switch ($result) {
	case 0: echo 0;
			break;
	case 1: echo 1;
			break;
	case 9999: echo 9999;
				break;
}

?>