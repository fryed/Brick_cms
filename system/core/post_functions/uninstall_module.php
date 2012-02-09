<?php

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO UNINSTALL A MODULE-----------//

//unset action
unset($this->posts["action"]);

//get list of themes
$DIRreader				=	new DIRreader();
$DIRreader->dir 		=	"theme/";
$DIRreader->folders 	=	true;
$themes					=	$DIRreader->getFiles();

//loop posts
foreach($this->posts as $key => $value){
	
	//delete modules
	$module = $key;
	$modulePath = "modules/".$module;
	unlink($modulePath."/".$module.".module.php");
	unlink($modulePath."/".$module.".admin.tpl");
	foreach($themes as $theme){
		$path = "theme/".$theme."/".$module."module.tpl";
		if(file_exists($path))
			unlink($path);
	}
	rmdir($modulePath);
	
	//remove from database
	DBconnect::delete("modules","name",$module);
	DBconnect::drop($module);
	
}

//set message
$_SESSION["messages"][] = "Message: Module/s uninstalled successfully.";

//go to page
header("Location: ".$this->homePath."/admin/modules");
exit;

?>