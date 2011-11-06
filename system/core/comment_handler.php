<?php

//-----SENDS OUT ALL THE COMMENTS TO THE BLOG-----//

class CMNThandler extends DBconnect {
	 	
	//set vars 
	var $pageInforArray;
	
	public function getComments(){
		
		if(isset($this->pageInfoArray["id"])){	
			$pageId 							= $this->pageInfoArray["id"];
			$params 							= "WHERE belongs_to = '$pageId' ORDER BY created";
			$this->pageInfoArray["comments"] 	= DBconnect::queryArray("*","blog_comments",$params);
	
			return $this->pageInfoArray;
		}
		
	}

}	
		
?>
