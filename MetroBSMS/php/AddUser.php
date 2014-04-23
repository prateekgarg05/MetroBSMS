<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/24/2014
 * 		File	 		: 			AddUser.php
 * 		Purpose			:			Adds a new user
 * 		Input			:			firstName, lastName, userName, password
 * 		Output			:			True or False
 */


require_once './Models/User.php';

$userName = $_REQUEST['userName'];
$password = $_REQUEST['password'];
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];

$user = new User();
$user->setFirstName($firstName);
$user->setLastName($lastName);
$user->setUserName($userName);
$user->setPassword($password);
$user->setDateCreated(date("Y-m-d H:i:s", time()));
$user->setDateModified(date("Y-m-d H:i:s", time()));

$result = $user->addUser();
 if ($result)
 	echo 1;
 else 
 	echo 0;

?>