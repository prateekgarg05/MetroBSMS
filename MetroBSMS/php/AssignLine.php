<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/14/2014
 * 		File	 		: 			AssignLine.php
 * 		Purpose			:			Assign the line to a crew
 * 		Input			:			crewName and lineNumber
 * 		Output			:			True or False
 */

require_once './Models/Crew.php';

$crewName = $_REQUEST['crewName'];
$lineNumber = $_REQUEST['lineNumber'];

$crew = new Crew();
$crew->setCrewName($crewName);

$result = $crew->assignLineToCrew($lineNumber);

if ($result)
	echo 1;
else
	echo 0;

?>