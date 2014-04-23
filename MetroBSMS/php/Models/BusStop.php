<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			02/11/2014
 * 		File	 		: 			Bus Stop.php
 * 		Purpose			:			Model class relates to the database table bus_stop_locations in the BSMS database
 * 		Input			:			NA
 * 		Output			:			NA 
 */

require_once './Helpers/DBHelper.php';

class BusStop {
	
	private $stopID;
	private $latitude;
	private $longitude;
	private $onStreet;
	private $crossStreet;
	private $direction;
	private $atorbetween;
	private $betweenstreet;
	private $nearfarmid;
	private $jurisdiction;
	
	//	Getters and Settters
	
	public function getStopID() {
		return $this->stopID;
	}
	public function setStopID($value) {
		$this->stopID = $value;
	}
	
	public function getLatitude() {
		return $this->latitude;
	}
	public function setLatitude($value) {
		$this->latitude = $value;
	}
	
	public function getLongitude() {
		return $this->longitude;
	}
	public function setLongitude($value) {
		$this->longitude = $value;
	}
	
	public function getOnStreet() {
		return $this->onStreet;
	}
	public function setOnStreet($value) {
		$this->onStreet = $value;
	}
	
	public function getCrossStreet() {
		return $this->crossStreet;
	}
	public function setCrossStreet($value) {
		$this->crossStreet = $value;
	}
	
	public function getDirection() {
		return $this->direction;
	}
	public function setDirection($value) {
		$this->direction = $value;
	}
	
	public function getAtorbetween() {
		return $this->atorbetween;
	}
	public function setAtorbetween($value) {
		$this->atorbetween = $value;
	}
	
	public function getBetweenstreet() {
		return $this->betweenstreet;
	}
	public function setBetweenstreet($value) {
		$this->betweenstreet = $value;
	}
	
	public function getNearfarmid() {
		return $this->nearfarmid;
	}
	public function setNearfarmid($value) {
		$this->nearfarmid = $value;
	}
	
	public function getJurisdiction() {
		return $this->jurisdiction;
	}
	public function setJurisdiction($value) {
		$this->jurisdiction = $value;
	}

	//	Object manipulation functions

	//	DB Functions
	public function getAllBusStops() {
		
		
	}
	
	public function getAllBusStopsForLine($lineNumber) {
		
		$query = "SELECT SQL_CACHE stop_locations.stopID, stop_locations.longitude, stop_locations.latitude, stop_locations.onstreet, stop_locations.crossstreet, stop_locations.direction, stop_locations.status, schedule.start_date, user.username FROM (SELECT * FROM bus_stop_newinfo ORDER BY longitude) stop_locations LEFT JOIN schedule ON schedule.stop_id = stop_locations.stopID LEFT JOIN user ON user.ID = schedule.user_id WHERE stop_locations.latitude Is NOT NULL AND stop_locations.longitude IS NOT NULL";
		//$query = "SELECT * FROM (SELECT * FROM bus_stop_locations ORDER BY longitude) stop_locations WHERE stop_locations.latitude Is NOT NULL AND stop_locations.latitude IS NOT NULL";
		//$query = "SELECT stop_locations.stopID, stop_locations.lineNumber, stop_locations.longitude, stop_locations.latitude, stop_locations.status, schedule.start_date, user.Username FROM (SELECT * FROM bus_stop_locations ORDER BY longitude) stop_locations LEFT JOIN schedule ON schedule.stop_id = stop_locations.stopID LEFT JOIN user ON user.id = schedule.user_id WHERE stop_locations.latitude Is NOT NULL AND stop_locations.latitude IS NOT NULL";
		if ($lineNumber > 0) {
			$query = "SELECT stop_locations.stopID, stop_locations.lineNumber, stop_locations.longitude, stop_locations.latitude, stop_locations.onstreet, stop_locations.crossstreet, stop_locations.direction, stop_locations.status, schedule.start_date, user.username FROM (SELECT * FROM bus_stop_newinfo ORDER BY longitude) stop_locations LEFT JOIN schedule ON schedule.stop_id = stop_locations.stopID LEFT JOIN user ON user.ID = schedule.user_id WHERE stop_locations.latitude Is NOT NULL AND stop_locations.longitude IS NOT NULL AND stop_locations.lineNumber = " . $lineNumber;
		}
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;		
	}
	
	public function getBusStopInformation($stopID) {
		
		$query = "SELECT stopID, longitude, latitude, onstreet, crossstreet, direction, atorbetween, betweenstreet, nearfarmid, jurisdiction";
		$query .= " FROM bus_stop_newinfo WHERE stopID = ";
		$query .= $stopID ." LIMIT 1";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
	}
	
	public function getLineNumbers()
	{
		$query = "SELECT DISTINCT lineNumber FROM bus_stop_newinfo WHERE lineNumber is NOT NULL and status = 'NA' ORDER BY lineNumber ASC";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
	}
	
	public function getUniqueBusStops() {
	
		$query = "SELECT SQL_CACHE DISTINCT stop_locations.stopID , stop_locations.longitude, stop_locations.latitude, stop_locations.onstreet, stop_locations.crossstreet, stop_locations.status, schedule.start_date, user.username FROM (SELECT * FROM bus_stop_newinfo ORDER BY longitude) stop_locations LEFT JOIN schedule ON schedule.stop_id = stop_locations.stopID LEFT JOIN user ON user.ID = schedule.user_id WHERE stop_locations.latitude Is NOT NULL AND stop_locations.longitude IS NOT NULL";		
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
	}
	
	public function saveRadiusSearchData($searchData,$type)
	{
		if ($type == '1')
			$query = "INSERT INTO radius_search_data(stopID,latitude,longitude,count,radius) VALUES(";
		else 
			$query = "INSERT INTO radius_search_data_unique(stopID,latitude,longitude,count,radius) VALUES(";
		$query .= $searchData['stopid'] . ",";
		$query .= "'" . $searchData['latitude'] . "',";
		$query .= "'" . $searchData['longitude'] . "',";
		$query .= $searchData['count'] . ",";
		$query .= $searchData['radius'] . ")";
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);
	}
	
	public function getRadiusSearchData($radius,$type)
	{
		if ($type == '1')			
			$query = "SELECT SQL_CACHE stopID,latitude,longitude,count FROM radius_search_data WHERE radius = ".$radius ." ORDER BY count DESC";
		else 
			$query = "SELECT SQL_CACHE stopID,latitude,longitude,count FROM radius_search_data_unique WHERE radius = ".$radius ." ORDER BY count DESC";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
	}
	
}

?>