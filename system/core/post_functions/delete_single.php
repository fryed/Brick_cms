<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO DELETE A SINGLE ROW-----------//

$this->tableCheck();

//check for resources to delete
$this->deleteResource();
	
//delete main table
DBconnect::delete($this->posts["table"],"id",$this->posts["id"]);

//set message
$_SESSION["messages"][] = "Message: Successfully deleted.";

header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;

?>