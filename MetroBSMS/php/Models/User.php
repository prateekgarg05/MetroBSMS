<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			03/10/2014
 * 		File	 		: 			User.php
 * 		Purpose			:			Model class relates to the database table user in the BSMS database
 * 		Input			:			NA
 * 		Output			:			NA 
 */

require_once './Helpers/DBHelper.php';

class User {
	
	private $id;
	private $firstName;
	private $lastName;
	private $userName;
	private $password;
	private $dateCreated;
	private $dateModified;
	private $lastLogin;
	private $crewID;
	
	
	//	Getters and Settters
	
	public function getID() {
		return $this->id;
	}
	public function setStopID($value) {
		$this->id = $value;
	}
	
	public function getFirstName() {
		return $this->firstName;
	}
	public function setFirstName($value) {
		$this->firstName = $value;
	}
	
	public function getLastName() {
		return $this->lastName;
	}
	public function setLastName($value) {
		$this->lastName = $value;
	}	
	
	public function getUserName() {
		return $this->userName;
	}
	public function setUserName($value) {
		$this->userName = $value;
	}
	
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($value) {
		$this->password = $value;
	}
	
	public function getDateCreated() {
		return $this->dateCreated;
	}
	public function setDateCreated($value) {
		$this->dateCreated = $value;
	}
	
	public function getDateModified() {
		return $this->dateModified;
	}
	public function setDateModified($value) {
		$this->dateModified = $value;
	}
	
	public function getLastLogin() {
		return $this->lastLogin;
	}
	public function setLastLogin($value) {
		$this->lastLogin = $value;
	}
	
	public function getCrewID() {
		return $this->crewID;
	}
	public function setCrewID($value) {
		$this->crewID = $value;
	}

	//	Object manipulation functions

	//	DB Functions
	public function getAllBusStops() {
		
		
	}
	
	public function authenticateUser() {
		$query = "SELECT * FROM user WHERE username = '" . $this->userName . "' AND password = '" . $this->password . "'";		
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		
		if (empty($resultArray)) {
			return 0;
		}
		else {
			if($this->userName == 'admin')
				return 9999;
			return 1;
		}
	}
	
	public function checkUserAvailability()
	{
		$query = "SELECT * FROM user WHERE username = '" . $this->userName . "'";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		
		if (empty($resultArray)) {
			return true;
		}
		else return false;
	}
	
	public function addUser()
	{
		$query = "INSERT INTO user(firstname, lastname, username, password, date_created, date_modified) VALUES(";
		$query .= "'" . $this->firstName . "',";
		$query .= "'" . $this->lastName . "',";
		$query .= "'" . $this->userName . "',";
		$query .= "'" . $this->password . "',";
		$query .= "'" . $this->dateCreated . "',";
		$query .= "'" . $this->dateModified . "')";
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);
		
		return true;
	}
	
	public function getUsernames($crewName)
	{
		$query = "SELECT username FROM user";
		if ($crewName != '') {
			$query = "SELECT user.username FROM user,crew WHERE crew.name = '" . $crewName ."' AND crew.id = user.crew_id";
		}
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
		
	}
	
	public function assignCrewToUser($crewName)
	{
		$query = "UPDATE user SET crew_id = (SELECT id FROM crew WHERE name = '" . $crewName . "'),";
		$query .= "date_modified = '" . $this->dateModified . "'";
		$query .= " WHERE username = '" . $this->userName . "'";
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);
		
		return true;
	}
	
	public function assignStopToUser($stopID)
	{
		$query = "INSERT INTO schedule(user_id,stop_id) VALUES((SELECT id FROM user WHERE username='";
		$query .= $this->userName . "')," . $stopID . ")";
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);
		
		$query = "UPDATE bus_stop_newinfo SET status = 'P' WHERE stopID = " . $stopID;
		$DB->openRunClose($query);
		return true;
	}
}

?>