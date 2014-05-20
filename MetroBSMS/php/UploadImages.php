<?php

/*
 *		Company			:			Civic Resource  Group (CRG)
*		Project			:			BSMS (Bus System Management System)
* 		Date 			:			04/22/2014
* 		File	 		: 			UploadImages.php
* 		Purpose			:			Uploads Images
* 		Input			:			username and image files
* 		Output			:			NULL
*/

require_once './Models/AssetData.php';

$username = $_REQUEST['username'];

$imageData = new AssetData();
$imageDataValues = $imageData->getImageDataRows($username);

$allowedExts = array("gif", "jpeg", "jpg", "png");
$flag = 0;

if ($_FILES['fileInput']) 
{
	$file_ary = reArrayFiles($_FILES['fileInput']);
	 
	if (count($imageDataValues) > 0)
	{
		foreach($imageDataValues as $imageDataItem)
		{	
			foreach ($file_ary as $fileItem)
			{			
				if ($imageDataItem["value"] == $fileItem["name"])
				{
					$flag = 1;
					$newFileName = $imageDataItem["id"] . "_" . $fileItem["name"];		
					$temp = explode(".", $fileItem["name"]);
					$extension = end($temp);
					if ((($fileItem["type"] == "image/gif")
					|| ($fileItem["type"] == "image/jpeg")
					|| ($fileItem["type"] == "image/jpg")
					|| ($fileItem["type"] == "image/pjpeg")
					|| ($fileItem["type"] == "image/x-png")
					|| ($fileItem["type"] == "image/png"))		
					&& in_array($extension, $allowedExts))
					  {
					  if ($fileItem["error"] > 0)
					    {
					    echo "Return Code: " . $fileItem["error"] . "<br>";
					    }
					  else
					    {
					    echo "Upload: " . $fileItem["name"] . "<br>";
					    echo "Type: " . $fileItem["type"] . "<br>";
					    echo "Size: " . ($fileItem["size"] / 1024) . " kB<br>";				    
						
					    $mypath = "../images/" .$imageDataItem["asset_id"];
					    if(!is_dir($mypath))
					    	mkdir($mypath,0755,TRUE);
					    
					    if (file_exists("../images/". $imageDataItem["asset_id"]."/". $newFileName))
					      {
					      echo $newFileName . " already exists. ";
					      }
					    else
					      {
					      move_uploaded_file($fileItem["tmp_name"],
					      "../images/". $imageDataItem["asset_id"]."/". $newFileName);
					      $fileItem["name"] = $newFileName;
					      $newPath = "/images/". $imageDataItem["asset_id"]."/". $newFileName;
					      				     
					      $imageData->saveImageDataToDB($fileItem,$newPath);
					      $imageID = $imageData->getNewImageId($newFileName);				      
					      $imageData->updateImageDataId($imageDataItem["id"],$imageID[0]["id"],$newFileName);
					      
					      echo "Stored in: " . "/images/". $imageDataItem["asset_id"]."/". $newFileName;
					      echo "<br /><br />";
					      break;
					      }
					    }
					  }
					else
					  {
					  echo "Invalid file";
					  echo "<br /><br />";
					  }								
				}
			}
		}
		if ($flag == 0)
			echo "The files you are trying to upload have no previous information in database";
	}
	
	else echo "There is no Incomplete Image data to be updated";
}


function reArrayFiles(&$file_post) {

	$file_ary = array();
	$file_count = count($file_post['name']);
	$file_keys = array_keys($file_post);

	for ($i=0; $i<$file_count; $i++) {
		foreach ($file_keys as $key) {
			$file_ary[$i][$key] = $file_post[$key][$i];
		}
	}

	return $file_ary;
}

?>