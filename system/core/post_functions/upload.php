<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO UPLOAD FILES-----------//

$this->tableCheck();
		
//run upload handler
$UPLOAD = new UPLOADhandler();
$UPLOAD->posts 			= $this->posts;
$UPLOAD->maxFileSize 	= $this->settingsArray["max_upload_size"];
$UPLOAD->allowedImages 	= $this->settingsArray["allowed_images"];
$UPLOAD->allowedFiles 	= $this->settingsArray["allowed_files"];
$UPLOAD->upload();
$errors					= $UPLOAD->getErrors();

//if no errors add info to db
if(!$errors){
	
	$keys 	= array();
	$values	= array();
	
	//loop through post data and create vars
	foreach($this->posts as $key => $value){
		
		if($key != "table" && $key != "action"){
			$keys[] 	= $key;
			$values[]	= "'$value'";
		}
		
	}
	
	$keys 	= implode(",",$keys);
	$values = implode(",",$values);
	
	switch($this->posts["table"]){
		
		case "images":
		$imageInfo 	= $UPLOAD->getUploadInfo();
		$imageSrc	= "system/data/images/".$imageInfo["name"];
		$keys 		= $keys.",src,width,height";
		$values		= $values.",'".$imageSrc."','".$imageInfo["width"]."','".$imageInfo["height"]."'";
		break;
		
		case "downloads":
		$downloadInfo 	= $UPLOAD->getUploadInfo();
		$downloadHref 	= "system/data/downloads/".$downloadInfo["name"];
		$keys 			= $keys.",src";
		$values			= $values.",'".$downloadHref."'";
		break;

	}

	//add table
	DBconnect::insert($this->posts["table"],$keys,$values);
	
}	

header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;

?>