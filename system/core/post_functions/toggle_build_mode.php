<?php

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO TOGGLE BUILD MODE ON MODULES-----------//

//unset action
unset($this->posts["action"]);

//loop posts
foreach($this->posts as $key => $value){
	
	//set params
	$params = "WHERE name = '".$key."'";
	
	//get build mode
	$bm = DBconnect::query("build_mode","modules",$params);
	
	//toogle build mode
	if(!$bm["build_mode"]){
		DBconnect::update("modules","build_mode","1",$params);
	}else{
		DBconnect::update("modules","build_mode","0",$params);
	}
	
}

//set message
$_SESSION["messages"][] = "Message: Module/s build mode updated.";

//go to page
header("Location: ".$this->homePath."/admin/modules");
exit;

?>