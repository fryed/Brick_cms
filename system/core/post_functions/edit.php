<?php 

//----------CALLED FROM POST HANDLER----------//
//----------GENERIC FUNCTION TO EDIT A ROW-----------//

$this->tableCheck();

//look for matching id in table
$params = "WHERE id = '".$this->posts["id"]."'";

//special rule for bricks
if($this->posts["table"] == "bricks"){
	//check for enabled
	if(isset($this->posts["enabled"])){
		$this->posts["enabled"] = true;
	}else{
		$this->posts["enabled"] = false;
	}
}

//loop through post data and save
$this->updateTable($params);

//set message
$_SESSION["messages"][] = "Message: Changes saved.";

//go to page
header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;	

?>