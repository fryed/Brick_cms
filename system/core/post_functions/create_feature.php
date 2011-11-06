<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO CREATE A FEATURE ITEM-----------//

$this->tableCheck();

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
	
	$keys 	= array();
	$values	= array();
	
	//set link based on wether external is set	
	foreach($this->posts as $key => $value){
		if($key == "external" && $value == "on")
			$this->posts["url"] = $this->posts["external_url"];		
	}		
	
	//unset unneeded values
	unset($this->posts["external_url"]);
	unset($this->posts["external"]);
	
	//loop through post data and create vars
	foreach($this->posts as $key => $value){
				
		if($key != "table" && $key != "action"){
			$keys[] 	= $key;
			$values[]	= "'$value'";
		}
		
	}
	
	$keys 	= implode(",",$keys);
	$values = implode(",",$values);

	//add image info to data
	$imageInfo 	= $UPLOAD->getUploadInfo();
	$imageSrc	= "/system/data/features/".$imageInfo["name"];
	$keys 		= $keys.",img_src,img_width,img_height";
	$values		= $values.",'".$imageSrc."','".$imageInfo["width"]."','".$imageInfo["height"]."'";

	//add table
	DBconnect::insert($this->posts["table"],$keys,$values);
	
	//set message
	$_SESSION["messages"][] = "Message: Feature created successfully.";
	
}	

//go to new page
header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;	

?>