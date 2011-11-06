<?php
//-----PROCESSES AND INSTALLS MODULES-----//

class MODhandler extends DBconnect{
	 	
	//set vars 
	var $homePath;
	var $moduleArray;
	var $siteInfoArray;
	var $navInfoArray;
	var $settingsArray;
	var $pageInfoArray;
	var $blogInfoArray;
	var $newsInfoArray;
	var $brickInfoArray;
	var $moduleInfoArray;
	
	public function installModules() {
		
		//set module info array
		$this->moduleInfoArray = array();

		//get list of modules from module folder
		$DIRreader					=	new DIRreader();
		$DIRreader->dir 			=	"modules";
		$DIRreader->folders			=	true;
		$moduleArray				=	$DIRreader->getFiles();
		
		//loop modules and install
		foreach($moduleArray as $module){

			$this->loadModule($module);
			
		}
		
		//check for manually deleted modules and remove from db
		$installedMods = DBconnect::queryArray("name","modules","");
		
		foreach($installedMods as $modRecord){
			if(!is_dir("modules/".$modRecord["name"])){
				DBconnect::delete("modules","name",$modRecord["name"]);
				DBconnect::drop($modRecord["name"]);
			}
		}
		
	}
	
	public function loadModule($module){
		
		//include the module file
		include_once("modules/".$module."/".$module.".module.php");
		
		//define module
		$moduleOb = new $module();
		//send info to module
		$moduleOb->module 			= array();
		$moduleOb->module["url"] 	= $this->homePath."/admin/modules/".$module;
		$moduleOb->site 			= $this->siteInfoArray;
		$moduleOb->menu 			= $this->navInfoArray;
		$moduleOb->page 			= $this->pageInfoArray;
		$moduleOb->blog 			= $this->blogInfoArray;
		$moduleOb->news 			= $this->newsInfoArray;
		$moduleOb->brick 			= $this->brickInfoArray;
		$moduleOb->settings 		= $this->settingsArray;
		
		//check if module is in db
		$params		= "WHERE name = '$module'";
		$installed 	= DBconnect::query("*","modules",$params);
		
		//if not add
		if(!$installed)
			DBconnect::insert("modules","name","'$module'");
		
		//if not installed run setup
		if(!$installed["installed"] || $installed["build_mode"]){
			
			$success = $moduleOb->setupModule();
			
			//if successfully installed update db	
			if($success)
				DBconnect::update("modules","installed","1",$params);
		}	
		
		//if module is installed run module
		if($installed["installed"]){
			
			//run module
			$moduleOb->runModule();
			
			//get module info
			$moduleInfo = $moduleOb->returnModule();
			
			//send to module array if no module template
			if(!isset($moduleInfo["template"]))
				$this->moduleInfoArray[$module] = $moduleInfo;
			
			//if the page exists
			if(isset($this->pageInfoArray["template"])){
			
				//send to module array if module temp matches page temp
				if($this->pageInfoArray["template"] == $moduleInfo["template"])
					$this->moduleInfoArray[$module] = $moduleInfo;
					
				//always sent to admin module page
				if($this->pageInfoArray["template"] == "../../modules/".$module."/".$module.".admin.tpl")
					$this->moduleInfoArray[$module] = $moduleInfo;
			
			}
			
		}
	
	}

	public function getModules(){
		
		return $this->moduleInfoArray;
		
	}
	
}	
		
?>