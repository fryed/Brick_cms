<?php 

//----------HANDLES BUILDING THE NAVIGATION----------//

class NAVbuilder extends DBconnect {
	 	
	var $pageUrl;
	var $simpleNav;
	var $menu;
	var $area;
	
	public function build(){
		
		$this->menuArray 	= 	DBconnect::queryArray("*","$this->menu","ORDER BY menu_order");

		$this->menu = array();
		
		if($this->menuArray){
		
			foreach($this->menuArray as $key => $menuItem){
					
				//check if enabled
				$menuItem = $this->checkEnabled($menuItem);	
							
				if($menuItem["enabled"] || $this->area == "admin"){ 	
				
					if($this->simpleNav){
						
						$menuItem = $this->getUrl($menuItem);
						
						$menuItem = $this->addClasses($menuItem);
						
						$menuItem["subNav"] = false;
						
						$this->menu[] = $menuItem;
						
					}else{
					
						//loop top level
						if($menuItem["parent"] == -1){
			
							$menuItem = $this->getUrl($menuItem);
							
							$menuItem = $this->addClasses($menuItem);
							
							$menuItem = $this->getSubPages($menuItem);
							
							$this->menu[] = $menuItem;
						
						}
		
					}
				
				}
	
			}
		
		}
	
	}
	
	public function getSubPages($menuItem){

		$menuItem["subNav"] = array();
		
		foreach($this->menuArray as $subItem){
			
			if($menuItem["page_id"] == $subItem["parent"]){
			
				$subItem = $this->getUrl($subItem);
				
				$subItem = $this->addClasses($subItem);
				
				$subItem = $this->checkEnabled($subItem);	
				
				$menuItem["subNav"][] = $this->getSubPages($subItem);
					
			}

		}
		
		return $menuItem;
	
	}
	
	public function checkEnabled($menuItem){
		
		//check for disabled pages and skip them
		$belongsTo 				= 	$menuItem["page_id"];
		$enabled 				=	DBconnect::query("enabled","pages","WHERE id = '$belongsTo'");
		$menuItem["enabled"]	=	$enabled["enabled"];
		
		return $menuItem;
		
	}
	
	public function addClasses($menuItem){
	
		if($menuItem["url"] == $this->pageUrl)
			$menuItem["active"] = true;
		else
			$menuItem["active"] = false;
			
		if($menuItem["type"] == "link")
			$menuItem["external"] = true;
		else
			$menuItem["external"] = false;
			
		return $menuItem;	
	
	}
	
	public function getUrl($menuItem){
		
		//get url and uri from pages table
		$pageId 		= 	$menuItem["page_id"];
		$params 		=	"WHERE id ='".$pageId."'";	
		
		$get 	= array("url","uri","section");
		$return = array();
		
		foreach($get as $value){
			
			$return[$value] = 	DBconnect::query($value,"pages",$params);
			
		}
	
		//set url, section and uri	
		switch($menuItem["type"]){
		
			case "page":
			$menuItem["url"] 		= $return["url"]["url"];	
			$menuItem["uri"] 		= $return["uri"]["uri"];
			$menuItem["section"] 	= $return["section"]["section"];
			break;
			
			case "link":
			$menuItem["url"] 		= $menuItem["link"];	
			$menuItem["uri"] 		= $menuItem["link"];	
			$menuItem["section"]	= "";	
			break;
		
		}
		
		return $menuItem;
		
	}
	
	public function getMenu(){	

		return $this->menu;
	
	}
	
}	

?>