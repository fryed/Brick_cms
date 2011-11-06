<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO EDIT A USER-----------//

$this->tableCheck();

//get current username
$params 	= "WHERE id = '".$this->posts["id"]."'";
$details 	= DBconnect::query("*",$this->posts["table"],$params);

//check for duplicate usernames
if($details["username"] != $this->posts["username"])
	$this->duplicateCheck("username",$this->posts["username"]);

//check both password fields match
if($this->posts["password"] != $this->posts["password2"]){
	
	//set message
	$_SESSION["errors"][] = "Error: Please ensure both password fields match.";

	//go to page
	header("Location: ".$this->homePath."/admin".$this->pageUrl);
	exit;
		
}

//look for matching id in table
$params = "WHERE id = '".$this->posts["id"]."'";

//unset password if hasnt changed if has, encode
if($this->posts["password"] == "----------")
	unset($this->posts["password"]);
else
	$this->posts["password"] = sha1($this->posts["password"]);
			
//unset password 2
unset($this->posts["password2"]);	
	
//loop through post data and save
$this->updateTable($params);

//set message
$_SESSION["messages"][] = "Message: Changes saved.";

//go to page
header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;	

?>