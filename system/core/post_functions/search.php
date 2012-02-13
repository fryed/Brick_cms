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
					
					//define terms
					$term = $this->posts["search"];
					$termLower = strtolower($this->posts["search"]);
					$termUpper = strtoupper($this->posts["search"]);
					
					//define value
					$valLower = strtolower($value);
					
					//check if term found
					$found = strpos($valLower,$termLower);
					
					//if found
					if($found !== false){
						$value 			= strip_tags($value);							
						$highlight		= "<span class='highLight'>".$term."</span>";
						$highlighted 	= str_replace($termLower,$highlight,$value);
						$highlighted 	= str_replace($termUpper,$highlight,$value);
						$highlighted 	= str_replace($term,$highlight,$value);
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