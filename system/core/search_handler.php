<?php

//-----SENDS OUT SEARCH RESULTS TO PAGE-----//

class SEARCHhandler {
	 	
	//set vars 
	var $pageInfoArray;
	
	public function getResults() {
		
		//grab search results from session then reset
		if(isset($_SESSION["search_results"])){
			if(is_array($_SESSION["search_results"])){	
				$this->pageInfoArray["search_results"] = $_SESSION["search_results"];
				unset($_SESSION["search_results"]);
			}	
		}else{
			$this->pageInfoArray["search_results"] = null;
		}

		return $this->pageInfoArray;
		
	}
	
}	
		
?>
