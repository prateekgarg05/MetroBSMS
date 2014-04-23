<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/24/2014
 * 		File	 		: 			GetCrew.php
 * 		Purpose			:			Gets the list of crew names
 * 		Input			:			Null
 * 		Output			:			json array of crew names
 */


require_once './Models/Crew.php';

$crew = new Crew();
$crewNames = $crew->getCrewnames();

$jsonResultArray = array("data" => $crewNames);

$jsonResult = json_encode($jsonResultArray);
echo $jsonResult;

?>