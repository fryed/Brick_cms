<?php

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO CREATE A MODULE-----------//

//set module var
$module = $this->posts["module_name"];

//get module.php
$module_core 	= file_get_contents("system/core/default_module/default_module.module.php");

//get module.tpl
$module_tpl 	= file_get_contents("system/core/default_module/default_module.admin.tpl");

//add the module name to the files
$module_core 	= str_replace("[module]",$module,$module_core);
$module_tpl 	= str_replace("[module]",$module,$module_tpl);

//check for duplicates
if(is_dir("modules/".$module)){
	
	//set error message
	$_SESSION["errors"][] = "Error: Module '".$module."' already exists.";
	
	//go to page
	header("Location: ".$this->homePath."/admin/modules");
	exit;
	
}

//make module folder
mkdir("modules/".$module);

//write module core file
$file 	= "modules/".$module."/".$module.".module.php";
$fp 	= fopen($file,"w");
fwrite($fp,$module_core);
fclose($fp);

//write module admin tpl file
$file 	= "modules/".$module."/".$module.".admin.tpl";
$fp 	= fopen($file,"w");
fwrite($fp,$module_tpl);
fclose($fp);

//set message
$_SESSION["messages"][] = "Message: Module created successfully.";

//go to page
header("Location: ".$this->homePath."/admin/modules/".$module);
exit;

?>