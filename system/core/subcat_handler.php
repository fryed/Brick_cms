<?php
//-----BRINGS BACK THE SUB-CATEGORIES-----//

class SUBCAThandler extends DBconnect{
	 	
	//set vars 
	var $pageUrl;
	var $pageInfoArray;
	
	public function getSubcats() {
		
		//only run if page is found
		if(isset($this->pageInfoArray["id"])){
		
			//get sub pages from pages table
			$pageId 		= $this->pageInfoArray["id"];
			$params			= "WHERE parent = '$pageId'";
			$subCatArray 	= DBconnect::queryArray("*","pages",$params);
			
			//send subcats to pageInfoArray
			$this->pageInfoArray["subCats"] = $subCatArray;
		
		}
		
		return $this->pageInfoArray;
		
	}
	
}	
		
?>
