<?php
//-----BRINGS BACK THE DOWNLOADS FOR PAGES-----//

class DLhandler extends DBconnect{
	 	
	//set vars 
	var $pageInfoArray;
	var $table;
	
	public function getDownloads(){
		
		//check for downloads
		if(isset($this->pageInfoArray["id"]) && !$this->pageInfoArray["custom"]){
	
			$area								= $this->table;
			$pageId 							= $this->pageInfoArray["id"];
			$params 							= "WHERE belongs_to = '$pageId' AND area = '$area'";
			$this->pageInfoArray["downloads"] 	= DBconnect::queryArray("*","downloads",$params);
		
		}
		
		return $this->pageInfoArray;
		
	}
	
}	
		
?>
