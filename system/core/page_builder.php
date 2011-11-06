<?php
//-----HANDLE BUILDING THE PAGE AND ASSIGNING THE SMARTY VARS-----//

class PAGEbuilder {
	 	
	//set vars 
	var $CMS;
	var $area;
	var $pageInfoArray;
	var $navInfoArray;
	var $siteInfoArray;
	var $blogInfoArray;
	var $newsInfoArray;
	var $moduleInfoArray;
	var $brickInfoArray;
	var $settingsArray;
	var $messages;
	
	public function buildPage() {
		
		//work out what template to display
		if(isset($this->pageInfoArray["template"])){
			
			switch($this->pageInfoArray["template"]){

				case "guard-dog.tpl":
				$this->guardDog();	
				break;

				case "login.tpl":
				$this->login();	
				break;
				
				case "maintenance.tpl":
				$this->maintenance();	
				break;

				default:
				$this->build();	
				break;	
				
			}
			
		}else{
			$this->error404();
		}	
					
	}
	
	public function build() {

		//assign diff vars based on area
		switch($this->area){
			
			case "admin":
			if(!$this->pageInfoArray["custom"]){
				$this->pageInfoArray["page_template"] 	= $this->pageInfoArray["template"];
				$this->pageInfoArray["template"]		= "edit-page.tpl";
			}
			$cacheId = "admin";
			break;
			
			default:
			//404 if area is blog and blog is disabled
			if($this->area == "blog" && !$this->settingsArray["blog"])
				$this->error404();
			
			//404 if area is news and news is disabled
			if($this->area == "news" && !$this->settingsArray["news"])
				$this->error404();
				
			//dont show disabled pages
			if(!$this->pageInfoArray["enabled"])
				$this->error404();
				
			$this->checkMaintenance();
			$cacheId = $this->pageInfoArray["url"];
			break;	
			
		}
		
		//assign cms settings vars
		//set file arrays back to string
		$this->settingsArray["allowed_images"] 	= implode(",",$this->settingsArray["allowed_images"]);
		$this->settingsArray["allowed_files"] 	= implode(",",$this->settingsArray["allowed_files"]);
		$this->CMS->assign("settings"	,	$this->settingsArray);
		
		//assign cms page info vars
		$this->CMS->assign("page"		,	$this->pageInfoArray);
		
		//assign cms site info vars
		$this->CMS->assign("site"		,	$this->siteInfoArray);
		
		//assign cms nav info vars
		$this->CMS->assign("menu"		,	$this->navInfoArray);
		
		//assign messages
		$this->CMS->assign("messages"	,	$this->messages);
		
		//assign blog
		if($this->settingsArray["blog"])	
			$this->CMS->assign("blog"	,	$this->blogInfoArray);
		
		//assign news
		if($this->settingsArray["news"])	
			$this->CMS->assign("news"	,	$this->newsInfoArray);
			
		//assign modules
		$this->CMS->assign("module"		,	$this->moduleInfoArray);
		
		//assign bricks
		$this->CMS->assign("brick"		,	$this->brickInfoArray);
	
		//display page
		$this->CMS->display("main.tpl"	,	$cacheId);
		
	}
	
	public function checkMaintenance(){
		
		//if in maintenance mode display maintennance tpl
		if($this->settingsArray["maintenance"]){
			if($this->settingsArray["ip_address"] != $this->settingsArray["stored_ip"])
				$this->maintenance();
		}
		
	}
	
	public function error404(){
		
		header("HTTP/1.0 404 Not Found");
		$this->CMS->display("../../system/admin_templates/404.tpl");
		exit;
		
	}
	
	public function guardDog(){
		
		$this->CMS->display("../../system/admin_templates/guard-dog.tpl");
		exit;
			
	}
	
	public function login(){
		
		$this->CMS->assign("messages",$this->messages);
		$this->CMS->display("../../system/admin_templates/login.tpl");
		exit;
		
	}
	
	public function maintenance(){
		
		$this->CMS->display("../../system/admin_templates/maintenance.tpl");
		exit;
		
	}
	
}	
		
?>
