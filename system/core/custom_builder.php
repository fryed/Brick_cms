<?php
//-----BUILDS CUSTOM FRONTEND PAGES NOT FOUND IN DB-----//

class CUSTOMbuilder {
	 	
	//set vars 
	var $pageInfoArray;
	var $pageUrl;
	
	public function getCustom() {
		
		switch($this->pageUrl){
			
			//set custom search page info
			case "/search":
				$this->pageInfoArray["template"] 	= "system/search.tpl";
				$this->pageInfoArray["url"] 		= $this->pageUrl;
				$this->pageInfoArray["uri"] 		= $this->pageUrl;
				$this->pageInfoArray["title"] 		= "Search";
				$this->pageInfoArray["name"] 		= "Search";
				$this->pageInfoArray["images"] 		= null;
				$this->pageInfoArray["created"] 	= null;
				$this->pageInfoArray["downloads"] 	= null;
				$this->pageInfoArray["id"] 			= null;
				$this->pageInfoArray["enabled"] 	= true;
				$this->pageInfoArray["custom"] 		= true;
				$this->pageInfoArray["keywords"] 	= "search";
				$this->pageInfoArray["description"] = "search";
				$this->pageInfoArray["section"] 	= "/search";
				
				//if set get search results
				$SEARCH = new SEARCHhandler();
				$SEARCH->pageInfoArray	=	$this->pageInfoArray;
				$this->pageInfoArray	=	$SEARCH->getResults();
			break;
			
			//set custom maintenance page
			case "/maintenance":
				$this->pageInfoArray["template"] 	= "maintenance.tpl";
				$this->pageInfoArray["title"] 		= "Maintenance";
				$this->pageInfoArray["name"] 		= "Maintenance";
				$this->pageInfoArray["enabled"] 	= true;
				$this->pageInfoArray["custom"] 		= true;
			break;
			
		}
		
		return $this->pageInfoArray;
		
	}
	
}	
		
?>
