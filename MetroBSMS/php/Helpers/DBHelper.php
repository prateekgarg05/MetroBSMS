<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
 *		Project			:			BSMS (Bus System Management System)
 * 		Date 			:			02/11/2014
 * 		File	 		: 			DBHelper.php
 * 		Purpose			:			Managing database transaction of the application
 * 		Input			:			NA	
 * 		Output			:			NA
 */

require_once './BSMS_config.php';

class DBHelper {
	
    private static $_singleton;
    private $dbHandle;

    public static function getInstance() {
        if(!self::$_singleton) {
            self::$_singleton = new DBHelper();
        }
        return self::$_singleton;
    }

    public function openConnection() {
    	$this->dbHandle = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    public function performQuery($query) {
    	$dbResult = $this->dbHandle->query($query);
    	if (is_object($dbResult)) {
			$resultArray = array();
			while ($row = $dbResult->fetch_assoc()) {
				array_push($resultArray, $row);
			}
			return $resultArray;
    	}    	
    }
    
    public function openRunClose($query) {
    	$this->openConnection();
    	$resultArray = $this->performQuery($query);
    	$this->closeConnection(); 	
    	return $resultArray;
    }

    public function closeConnection() {
       $this->dbHandle->close();
    }

}

?>