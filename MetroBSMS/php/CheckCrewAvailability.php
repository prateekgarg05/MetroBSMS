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


require_once './Models/Crew.php';

$crewName = $_REQUEST['crewName'];

$crew = new Crew();
$crew->setCrewName($crewName);

$result = $crew->checkCrewAvailability();
 if ($result)
 	echo 1;
 else 
 	echo 0;

?>