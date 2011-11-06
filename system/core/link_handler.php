<?php
//-----BRINGS BACK THE LINKS FOR SITE-----//

class LINKhandler extends DBconnect{
	 	
	//set vars 
	var $siteInfoArray;
	
	public function getLinks() {
		
		$this->siteInfoArray["links"] 	= DBconnect::queryArray("*","links","");
		
		return $this->siteInfoArray;
		
	}
	
}	
		
?>
