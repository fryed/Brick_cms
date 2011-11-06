<?php
//-----INSPECTS THE URL AND LOOKS FOR ADMIN BLOG NEWS ETC-----//
//--RETURNS THE INFO NEEDED TO BRING BACK DATA FOR THE PAGE-----//

class URIcontroller {
	 	
	//set vars 
	var $pageName;
	var $pageUri;
	var $pageUrl;
	var $sections;
	var $home;
	var $area;	
	var $logStatus;	
	
	//get uri fuction
	public function URIcontroller() {
		
		//get uri
		$requestURI = explode("/",$_SERVER["REQUEST_URI"]);
	
		//get filename
		$scriptName = explode("/",$_SERVER["SCRIPT_NAME"]);
		
		//get servername
		$serverName = $_SERVER["SERVER_NAME"];
			
		//remove unwanted parts
		for($i=0; $i < sizeof($scriptName); $i++){
			if($requestURI[$i] == $scriptName[$i]){
				unset($requestURI[$i]);
			}
		}
		
		//remove null values
		$uriArray = array_values($requestURI);
		if(end($uriArray) == "")
			array_pop($uriArray);
			
		//remove query strings
		$length = sizeof($uriArray)-1;
		if($length >= 0){
			$uriArray[$length] = explode("?",$uriArray[$length]);
			$uriArray[$length] = $uriArray[$length][0];
		}
		
		//get page name
		$pageName = end($uriArray);
		
		//handle unwanted backslash at end of uriArray
		$i = 0;
		foreach($uriArray as $uriItem){
			if($uriItem == "")
				unset($uriArray[$i]);
			$i++;		
		}

		//get sections
		$sections = $uriArray;
		array_pop($sections);
			
		//check for area ie. admin, blog, news
		if(isset($uriArray[0])){
			switch($uriArray[0]){
				
				//admin functions
				case "admin":
				$this->area	 =	"admin";
				unset($uriArray[0]);
				
				//check for logout/login
				if(isset($uriArray[1])){
					
					switch ($uriArray[1]){
				
						case "login":
						$this->logStatus = "enter";
						break;	
						
						case "logout":
						$this->logStatus = "leave";
						break;
	
						case "guarddog":
						$this->logStatus = "guardDog";
						break;
						
						default:
						$this->logStatus = false;
					
					}
					
				}
				break;	
				
				case "blog":
				$this->area	 =	"blog";
				break;
				
				case "news":
				$this->area	 =	"news";
				break;
				
			}
		}

		//get page url
		$pageUri = "/".$pageName;
		
		//get page uri
		$pageUrl = implode("/",$uriArray);
		$pageUrl = "/".$pageUrl;
		
		//set home path	
		$removePage = array_pop($scriptName);	
		$scriptName = implode("/",$scriptName);
		$home 		= "http://".$serverName.$scriptName;
		
		//set vars
		$this->pageName 	= 	$pageName;
		$this->pageUri 		= 	$pageUri;
		$this->pageUrl 		= 	$pageUrl;
		$this->sections 	= 	$sections;
		$this->home			= 	$home;
		
	}
	
	public function getName(){
		
		return $this->pageName; 
			
	}
	
	public function getUri(){
		
		return $this->pageUri; 
			
	}
	
	public function getUrl(){
		
		return $this->pageUrl; 
			
	}
	
	public function getSections(){
		
		return $this->sections; 
			
	}
	
	public function getHomePath(){
		
		return $this->home; 
			
	}
	
	public function checkArea(){
		
		return $this->area; 
			
	}
	
	public function checkLogStatus(){
		
		return $this->logStatus; 
			
	}
		
}

?>