<?php

//-----SENDS ALL GLOBAL SITE INFO TO PAGE-----//

class SITEinfo extends DBconnect {
	 	
	//set vars 
	var $siteInfoArray;
	
	public function getInfo() {
		
		//get site logo
		$params		=	"WHERE belongs_to = '-2'";
		$logo 		= 	DBconnect::query("*","images",$params);
			
		//send logo to pageInfoArray
		$this->siteInfoArray["logo"] = $logo;
		
		//get site favicon
		$params		=	"WHERE belongs_to = '-3'";
		$favicon 	= 	DBconnect::query("*","images",$params);
			
		//send favicon to pageInfoArray
		$this->siteInfoArray["favicon"] = $favicon;
			
		//get site info
		$siteInfo = DBconnect::query("*","site","");
		
		//sent site info to page
		foreach($siteInfo as $key => $value){
			
			if($key != "id")
				$this->siteInfoArray[$key] = $value;
			
		}

		return $this->siteInfoArray;
			
	}
		
}	
		
?>
