<?php
//-----BUILDS CUSTOM FRONTEND PAGES NOT FOUND IN DB-----//

class CUSTOMbuilder {
	 	
	//set vars 
	var $pageInfoArray;
	var $pageUrl;
	
	public function getCustom() {
		
		switch($this->pageUrl){
			
			case "/search":
			//set custom page info
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
			
			//if set get search results
			$SEARCH = new SEARCHhandler();
			$SEARCH->pageInfoArray	=	$this->pageInfoArray;
			$this->pageInfoArray	=	$SEARCH->getResults();
			break;
			
		}
		
		return $this->pageInfoArray;
		
	}
	
}	
		
?>
