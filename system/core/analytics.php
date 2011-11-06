<?php

//-----TRACKS PAGE VISITS AND THE LIKE-----//

class analytics extends DBconnect {
	 	
	//set vars 
	var $pageUrl;
	var $area;
	var $table;
	var $siteInfoArray;
	
	public function track() {

		//dont track admin
		if($this->area != "admin"){
			
			//--get number of visitors to page--//
			//get visits
			$params = "WHERE url = '$this->pageUrl'";
			$visits = DBconnect::query("page_visits","$this->table",$params);
			
			//add one every time page is loaded
			$newVisits = $visits["page_visits"]+1;
				
			//save to db
			DBconnect::update("$this->table","page_visits",$newVisits,$params);
			
			//--save referer--//
			
			if(isset($_SERVER["HTTP_REFERER"]))
				$referer = $_SERVER["HTTP_REFERER"];

			//check if referer is from external site 
			if(isset($referer)){

				//get server name
				$serverName = $_SERVER["SERVER_NAME"];
				
				//get referers server
				$refererParts 	= explode("/",$referer);
				$refererServer 	= $refererParts[2];
				
				if($serverName != $refererServer){
					
					//check for existing entry
					$params = "WHERE referer = '$referer'";
					$exists = DBconnect::query("visits","analytics",$params);

					if(!$exists){
						
						//create entry
						$keys 	=	"referer,visits";
						$values	=	"'".$referer."','1'";
						DBconnect::insert("analytics",$keys,$values);
						
					}else{
						
						//update visit count
						$count 		= $exists["visits"]+1;
						DBconnect::update("analytics","visits",$count,$params);
						
					}
					
				}
				
			}	
			
		}
		
	}
	
	public function getAnalytics(){
		
		//get page views
		$pageVisits	=	array();
		
		$i = 0;
		foreach($this->siteInfoArray["pages"] as $page){
			
			$pageVisits[$i]["name"] 	= $page["name"];
			$pageVisits[$i]["visits"]	= $page["page_visits"];
			$pageVisits[$i]["url"] 		= $page["url"];
			$i++;
			
		}
		
		//get referers
		$referers = DBconnect::query("*","analytics","");
		
		//send to siteinfo array
		$this->siteInfoArray["analytics"] 					= array();
		$this->siteInfoArray["analytics"]["page_visits"] 	= $pageVisits;
		$this->siteInfoArray["analytics"]["referers"] 		= $referers;
		
		return $this->siteInfoArray;
		
	}

}	
		
?>
