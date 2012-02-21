<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO EDIT A PAGE-----------//

$this->tableCheck();
		
//check for duplicate url's
if($this->posts["url"] != $this->pageUrl)
	$this->duplicateCheck("url",$this->posts["url"]);
	
//look for matching url
$pageId = $this->posts["id"];
$params = "WHERE id = '".$pageId."'";

//handle sections
if(isset($this->posts["section"])){

	//split id from url
	$sectionInfo = explode(">",$this->posts["section"]);
	
	//save id and url
	$url 	= $sectionInfo[0];
	$id		= $sectionInfo[1];
	
	$this->posts["section"] = $url;
	
	//build new uri
	$url 				= $url.$this->posts["uri"];
	$this->posts["url"] = $url;
	
	//set parent
	$this->posts["parent"] = $id;
	
}else{
	
	$this->posts["parent"] = -1;
	
}

//handle page enabled
if(isset($this->posts["enabled"]))
	$this->posts["enabled"] = true;
else
	$this->posts["enabled"] = false;

//save post data
$this->updateTable($params);

//update menu if page
if($this->posts["table"] == "pages"){
	
	$parent		= $this->posts["parent"];
	$menuParams = "WHERE page_id ='".$pageId."'";	
	DBconnect::update("main_nav","parent",$parent,$menuParams);
	
	//tables to check for changes
	$checkTable = array("main_nav","header_nav","footer_nav");
	
	//look for matching menu id
	$params = "WHERE page_id = '".$pageId."'";	
	
	//check for name change
	foreach($checkTable as $table){
		DBconnect::update($table,"name",$this->posts["name"],$params);
	}
	
}

//set message
$_SESSION["messages"][] = "Message: Changes saved.";

//go to new page
header("Location: ".$this->homePath."/admin".$this->posts["url"]);
exit;

?>