<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO EDIT A FEATURE ITEM-----------//

$this->tableCheck();

//look for matching id in table
$params = "WHERE id = '".$this->posts["id"]."'";

//check for new image
if($_FILES["upload"]["name"] != ""){
	
	//delete old image
	$this-> deleteResource();
	unset($this->posts["img_src"]);
	
	//handle image upload
	//run upload handler
	$UPLOAD = new UPLOADhandler();
	$UPLOAD->posts 			= $this->posts;
	$UPLOAD->maxFileSize 	= $this->maxFileSize;
	$UPLOAD->allowedImages 	= $this->allowedImages;
	$UPLOAD->allowedFiles 	= $this->allowedFiles;
	$UPLOAD->upload();
	$errors					= $UPLOAD->getErrors();
	
	//if no errors add info to db
	if(!$errors){
		
		$imageInfo 	= $UPLOAD->getUploadInfo();
		$this->posts["img_src"]		= "/system/data/features/".$imageInfo["name"];
		$this->posts["img_width"]	= $imageInfo["width"];
		$this->posts["img_height"]	= $imageInfo["height"];
		
	}	
	
}

//set link based on wether external is set	
foreach($this->posts as $key => $value){
	if($key == "external" && $value == "on")
		$this->posts["url"] = $this->posts["external_url"];		
}		

//unset unneeded values
unset($this->posts["external_url"]);
unset($this->posts["external"]);
unset($this->posts["upload"]);

//loop through post data and save
$this->updateTable($params);

//set message
$_SESSION["messages"][] = "Message: Changes saved.";

//go to page
header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;	

?>