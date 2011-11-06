<?php

//-----SENDS OUT FEATURE SHOWCASE TO PAGE-----//

class FEAThandler extends DBconnect {
	 	
	//set vars 
	var $siteInfoArray;
	
	public function getFeatures(){
		
		$this->siteInfoArray["features"] = DBconnect::queryArray("*","features","");
			
		return $this->siteInfoArray;
		
	}
		
}	
		
?>
