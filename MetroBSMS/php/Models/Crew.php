<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/24/2014
 * 		File	 		: 			Crew.php
 * 		Purpose			:			Model class relates to the database table crew in the BSMS database
 * 		Input			:			NA
 * 		Output			:			NA 
 */

require_once './Helpers/DBHelper.php';

class Crew {
	
	private $id;
	private $crewName;
	
	
	//	Getters and Settters
	
	public function getID() {
		return $this->id;
	}
	public function setStopID($value) {
		$this->id = $value;
	}
	
	public function getCrewName() {
		return $this->crewName;
	}
	public function setCrewName($value) {
		$this->crewName = $value;
	}	
	
	//	Object manipulation functions

	//	DB Functions
		
	public function checkCrewAvailability()
	{
		$query = "SELECT * FROM crew WHERE name = '" . $this->crewName . "'";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		
		if (empty($resultArray)) {
			return true;
		}
		else return false;
	}
	
	public function addCrew()
	{
		$query = "INSERT INTO crew(name) VALUES(";		
		$query .= "'" . $this->crewName . "')";
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);
		
		return true;
	}
	
	public function getCrewnames()
	{
		$query = "SELECT name FROM crew";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
	
	}
	
	public function assignLineToCrew($lineNumber)
	{
		$query1 ="SELECT SQL_CACHE DISTINCT stopID,lineNumber FROM bus_stop_newinfo WHERE lineNumber=". $lineNumber." ORDER BY longitude";
		$DB = DBHelper::getInstance();
		$stopsArray = $DB->openRunClose($query1);
		
		$query2 ="SELECT SQL_CACHE user.id FROM user,crew WHERE user.crew_id = crew.id and crew.name = '". $this->crewName . "'";		
		$usersArray = $DB->openRunClose($query2);
		
		$flag = 0;
		$index = 0;
		
		for($i = 0; $i < count($usersArray); $i++)
		{			
			for($j = 1+($index*5); $j <= 5+($index*5); $j++)
			{
				if(!empty($stopsArray[$j-1]))
				{
					$query = "INSERT INTO schedule (user_id,line_no,stop_id) VALUES (";
					$query .= $usersArray[$i]["id"] .",";
					$query .= $stopsArray[$j-1]["lineNumber"] .",";
					$query .= $stopsArray[$j-1]["stopID"] .")";
					$DB->openRunClose($query);
					$query3 = "UPDATE bus_stop_newinfo SET status = 'P' WHERE stopID = " . $stopsArray[$j-1]["stopID"];
					$DB->openRunClose($query3);
				}
				else {
					$flag = 1;
					break;
				}
			}
			$index++;
			if ($i == (count($usersArray) - 1))
				$i = -1;
			if ($flag == 1)
				break;
		}
		
		return true;
	}
}

?>