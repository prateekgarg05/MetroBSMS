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


require_once './Models/Crew.php';

$crewName = $_REQUEST['crewName'];

$crew = new Crew();
$crew->setCrewName($crewName);

$result = $crew->addCrew();
 if ($result)
 	echo 1;
 else 
 	echo 0;

?>