<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO CREATE A USER-----------//

$this->tableCheck();

//check for duplicate usernames
$this->duplicateCheck("username",$this->posts["username"]);

//check both password fields match
if($this->posts["password"] != $this->posts["password2"]){
	
	//set message
	$_SESSION["errors"][] = "Error: Please ensure both password fields match.";

	//go to page
	header("Location: ".$this->homePath."/admin".$this->pageUrl);
	exit;
		
}

//encode password
$this->posts["password"] = sha1($this->posts["password"]);

//unset password 2
unset($this->posts["password2"]);
		
//create the table
$this->createTable();

//set message
$_SESSION["messages"][] = "Message: User created.";

//go to page
header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;	

?>