<?php

//-----SENDS ALL SITE SETTINGS TO THE PAGE-----//

class GETsettings extends DBconnect {
	 	
	//set vars 
	var $settingsArray;
	
	public function settings() {
		
		//reset maintenance message
		unset($_SESSION["errors"]["maintenance"]); 
		
		//get site settings
		$params		=	"WHERE id = '1'";
		$settings 	= 	DBconnect::query("*","settings",$params);
			
		//create arrays from allowed files and images
		$fileArray 	= explode(",",$settings["allowed_files"]);	
		$imgArray 	= explode(",",$settings["allowed_images"]);
		$settings["allowed_files"] 	= $fileArray;
		$settings["allowed_images"] = $imgArray;	
		
		//get ip for maintenance mode
		$settings["stored_ip"] = $settings["ip_address"];
		$settings["ip_address"] = $_SERVER["REMOTE_ADDR"];
		
		//set maintenance message
		if($settings["maintenance"])
			$_SESSION["errors"]["maintenance"] = "Caution: Now working in maintenance mode.";	
		  
		//get list of themes
		$DIRreader				=	new DIRreader();
		$DIRreader->dir 		=	"theme/";
		$DIRreader->folders		=	true;
		$settings["themes"]		=	$DIRreader->getFiles();	
		
		//sent to settings array
		$this->settingsArray = $settings;	
			
		return $this->settingsArray;
			
	}
		
}	
		
?>
