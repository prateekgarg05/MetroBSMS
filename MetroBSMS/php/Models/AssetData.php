<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			02/11/2014
 * 		File	 		: 			Asset Data.php
 * 		Purpose			:			Model class relates to the database table asset_data in the BSMS database
 * 		Input			:			NA
 * 		Output			:			NA 
 */

require_once './Helpers/DBHelper.php';

class AssetData {
	
	private $id;
	private $assetTypeID;
	private $informationTypeID;
	private $fieldTypeID;
	private $assetID;
	private $value;
	private $domainValueID;
	private $imageID;
	private $enteredByUserID;
	private $dateCreated;
	private $dateModified;
	
	//	Getters and Settters
	public function getID() {
		return $this->id;
	}
	public function setID($value) {
		$this->id = $value;
	}
	
	public function getAssetTypeID() {
		return $this->assetTypeID;
	}
	public function setAssetTypeID($value) {
		$this->assetTypeID = $value;
	}
	
	public function getInformatioTypeID() {
		return $this->informationTypeID;
	}
	public function setInformationTypeID($value) {
		$this->informationTypeID = $value;
	}
	
	public function getFieldTypeID() {
		return $this->fieldTypeID;
	}
	public function setFieldTypeID($value) {
		$this->fieldTypeID = $value;
	}
	
	public function getAssetID() {
		return $this->assetID;
	}
	public function setAssetID($value) {
		$this->assetID = $value;
	}
	
	public function getValue() {
		return $this->value;
	}
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function getDomainValueID() {
		return $this->domainValueID;
	}
	public function setDomainValueID($value) {
		$this->domainValueID = $value;
	}
	
	public function getImageID() {
		return $this->imageID;
	}
	public function setImageID($value) {
		$this->imageID = $value;
	}
	
	public function getEnteredByUserID() {
		return $this->enteredByUserID;
	}
	public function setEnteredByUserID($value) {
		$query = "SELECT ID FROM user WHERE Username='".$value."'";		
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		foreach ($resultArray as $row) {			
			$this->enteredByUserID = $row["ID"];
			break;
		}
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

	//	Object manipulation functions
	public function createObjectFromArray($assetData) {
		$this->setAssetTypeID($assetData['assettype_id']);
		$this->setInformationTypeID($assetData['informationtype_id']);
		$this->setFieldTypeID($assetData['fieldtype_id']);
		$this->setAssetID($assetData['asset_id']);
		$this->setValue($assetData['value']);
		
		if ($assetData['value'] == "") {
			$this->setValue("NULL");
		}
		else {
			$this->setValue($assetData['value']);
		}
		if ($assetData['domainvalue_id'] == "") {
			$this->setDomainValueID("NULL");
		}
		else {
			$this->setDomainValueID($assetData['domainvalue_id']);
		}
		if (isset($assetData['image_id'])) {
			$this->setImageID($assetData['image_id']);
		}
		else {
			$this->setImageID("NULL");
		}
		$this->setEnteredByUserID($assetData['enteredby_username']);
		$this->setDateCreated(date("Y-m-d H:i:s", time()));
		$this->setDateModified(date("Y-m-d H:i:s", time()));
	}
	//	DB Functions
	
	public function saveToDB() {
		//Save BusStop data
		$query  = "INSERT INTO asset_data(assettype_id, informationtype_id, fieldtype_id, asset_id, value, domainvalue_id, image_id, enteredby_user_id, date_created, date_modified) VALUES (";
		$query .= $this->assetTypeID . ",";
		$query .= $this->informationTypeID . ",";
		$query .= $this->fieldTypeID . ",";
		$query .= $this->assetID . ",";
		$query .= "'" . $this->value . "',";
		$query .= $this->domainValueID . ",";
		$query .= $this->imageID . ",";
		$query .= $this->enteredByUserID . ",";
		$query .= "'" . $this->dateCreated . "',";
		$query .= "'" . $this->dateModified. "'";
		$query .= ")";		
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);
				
	}
	
	public function updateBusStopStatus()	{
		//Update BusStop status
		$query = "UPDATE bus_stop_newinfo SET userID=" . $this->enteredByUserID . ", status ='C', date ='" . $this->dateModified ."' WHERE stopID = " . $this->assetID;
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);
		
	}
	
	public function getMaxStopID()
	{
		$query = "SELECT MAX(asset_id) AS MaxID FROM asset_data";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
	}
	
	public function getImageDataRows($username)
	{
		$query = "SELECT asset_data.id, asset_data.value, asset_data.asset_id FROM asset_data,user WHERE";
		$query .= " user.username = '" . $username ."' AND user.id = asset_data.enteredby_user_id AND fieldtype_id = 71 AND image_id IS NULL OR image_id = NULL";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
	}
	
	public function saveImageDataToDB($imageData,$newPath)
	{
		$query = "INSERT INTO image(name,path,type,size,date_created,date_modified) VALUES(";
		$query .= "'" .$imageData["name"] ."',";
		$query .= "'" .$newPath. "',";
		$query .= "'" .$imageData["type"] ."',";
		$query .= "'" .($imageData["size"] / 1024) . " kB',";
		$query .= "'".date("Y-m-d H:i:s", time())."',";
		$query .= "'".date("Y-m-d H:i:s", time())."')";
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);		
	}
	
	public function getNewImageId($imageName)
	{
		$query = "SELECT id FROM image WHERE name='". $imageName ."'";
		$DB = DBHelper::getInstance();
		$resultArray = $DB->openRunClose($query);
		return $resultArray;
	}
	
	public function updateImageDataId($imageDataId, $imageID, $newFileName)
	{
		$query = "UPDATE asset_data SET ";
		$query .= "image_id = " .$imageID ." ,value='" . $newFileName ."', date_modified='".date("Y-m-d H:i:s", time())."' WHERE id = " . $imageDataId;  
		$DB = DBHelper::getInstance();
		$DB->openRunClose($query);
	}
	
}

?>