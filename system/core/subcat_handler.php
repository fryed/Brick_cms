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
			
			//get subcats main image
			foreach($subCatArray as $key => $val){
				if(isset($val["image_id"])){
					$params = "WHERE id=".$val["image_id"];
					$subCatArray[$key]["main_image"] = DBconnect::query("*","images",$params);
				}
			}
			
			//send subcats to pageInfoArray
			$this->pageInfoArray["subCats"] = $subCatArray;
		
		}
		
		return $this->pageInfoArray;
		
	}
	
}	
		
?>
