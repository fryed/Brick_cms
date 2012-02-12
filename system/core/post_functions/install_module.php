<?php

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO INSTALL A MODULE-----------//

//handle upload
$module = $_FILES["module"];

//if not zip file send error 
if($module["type"] != "application/x-zip-compressed"){
	
	//set error
	$_SESSION["errors"][] = "Error: Module must be in zip format.";

	//go to page
	header("Location: ".$this->homePath."/admin/modules");
	exit;
	
}

//get module name
$moduleName = str_replace(".zip","",$module["name"]);

//check for duplicates
if(is_dir("modules/".$moduleName)){
	
	//set error message
	$_SESSION["errors"][] = "Error: Module '".$module."' already exists.";
	
	//go to page
	header("Location: ".$this->homePath."/admin/modules");
	exit;
	
}

//make module dir
mkdir("modules/".$moduleName);

//get list of themes
$DIRreader				=	new DIRreader();
$DIRreader->dir 		=	"theme/";
$DIRreader->folders 	=	true;
$themes					=	$DIRreader->getFiles();

//open zip
$zip = zip_open($module["tmp_name"]);

//read zip
while($zipEntry = zip_read($zip)){
	
	//get file info
	$fileName 		= preg_replace("/$moduleName/","",zip_entry_name($zipEntry),1);
	$fileContents 	= zip_entry_read($zipEntry,1000000);
	$paths			= array();
	
	//check for core file
	$pos = strrpos($fileName,".module.php");
	if($pos !== false){
		$paths[] = "modules/".$moduleName;
	}
	//check for admin file
	$pos = strrpos($fileName,".admin.tpl");
	if($pos !== false){
		$paths[] = "modules/".$moduleName;
	}
	//check for tpl file
	$pos = strrpos($fileName,".module.tpl");
	if($pos !== false){
		foreach($themes as $theme){
			$paths[] = "theme/".$theme;
		}
	}
	
	//install files
	foreach($paths as $path){
		$file 	= $path."/".$fileName;
		$fp		= fopen($file,"w");
		fwrite($fp,$fileContents);
		fclose($fp);
	}
	
	zip_entry_close($zipEntry);
	
}

//close zip
zip_close($zip);

//set message
$_SESSION["messages"][] = "Message: Module '".$moduleName."' installed successfully.";

//go to page
header("Location: ".$this->homePath."/admin/modules/".$moduleName);
exit;

?>