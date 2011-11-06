<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO TO SEARCH SITE-----------//

//check for search term
if($this->posts["search"] == ""){
	$_SESSION["errors"][] = "Error: Please enter a search term.";
}else{

	//set search arrays
	$searchTables  	= array();
	$searchResults 	= array();
	$total			= 0;
	
	//check for filter
	if(isset($this->posts["filter"])){
		
		$searchTables[] = $this->posts["filter"];	
		
	}else{
		
		$searchTables[] = "pages";
		
		if($this->settingsArray["news"])
			$searchTables[] = "news";
		if($this->settingsArray["blog"])
			$searchTables[] = "blog";
		
	}
	
	//search tables
	foreach($searchTables as $searchTable){
		
		//get pages
		$pages = DBconnect::query("*",$searchTable,"");
		
		//search items
		foreach($pages as $page){
				
			$result = false;	
				
			foreach($page as $key => $value){
				if($key == "content" || $key == "title" || $key == "name" || $key == "url"){
						
					$found = strpos($value,$this->posts["search"]);	
					if($found !== false){							
						$highlight		= "<span class='highLight'>".$this->posts["search"]."</span>";
						$highlighted 	= str_replace($this->posts["search"],$highlight,$value);
						$page[$key]		= $highlighted;
						$result = true;
					}	
					
				}
			}
			
			if($result){
				$searchResults[] = $page;
				$total++;
			}
			
		}	
	}
	
	//send results to session
	$_SESSION["search_results"] = $searchResults;
	
	//set message
	$_SESSION["messages"][] = "'".$total."' results found for '".$this->posts["search"]."'.";
}	

//go to new page
header("Location: ".$this->homePath."/search");
exit;	

?>