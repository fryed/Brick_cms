<?php

//-----SENDS OUT THE CRUMBS TO THE PAGE-----//

class CRUMBhandler {
	 	
	//set vars 
	var $crumbs;
	var $homePath;
	var $pageName;
	var $sections;
	
	public function getCrumbs() {

		$this->crumbs = array();
		
		//set home crumb
		$this->crumbs[0] 			= array();
		$this->crumbs[0]["name"] 	= "Home"; 
		$this->crumbs[0]["url"] 	= $this->homePath; 
			
		//set other crumbs
		$i = 1;
		foreach($this->sections as $section){
			$this->crumbs[$i] 			= array();
			$this->crumbs[$i]["url"] 	= $this->homePath."/".$section; 
			$section 					= str_replace("_"," ",$section);
			$section 					= str_replace("-"," ",$section);
			$this->crumbs[$i]["name"] 	= $section; 
			$i++;
		}
		
		//set current crumb
		if($this->pageName != ""){
			$sectionNo = count($this->sections);
			$this->crumbs[$sectionNo+1] 			= array();
			$name									= str_replace("_"," ",$this->pageName);
			$this->crumbs[$sectionNo+1]["name"] 	= str_replace("_"," ",$this->pageName);
			$this->crumbs[$sectionNo+1]["url"] 		= "#"; 
		}

		return $this->crumbs;
		
	}
	
}	
		
?>
