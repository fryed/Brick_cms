<?php
//-----PROCESSES BRICKS-----//

class BRICKhandler extends DBconnect{
	 	
	//set vars 
	var $pageInfoArray;
	var $brickInfoArray;
	
	//function to get the bricks
	public function getBricks(){
		
		$params = "WHERE enabled=1";
		$bricks = DBconnect::queryArray("*","bricks",$params);
		
		if(!isset($this->pageInfoArray["template"])){
			$this->pageInfoArray["template"] = null;
		}
		
		foreach($bricks as $brick){
			if($brick["page_template"] == $this->pageInfoArray["template"] || $brick["page_template"] == "global"){
				$this->brickInfoArray[$brick["brick_name"]] = $brick;
			}
		}
		
		return $this->brickInfoArray;
		
	}
	
}	
		
?>