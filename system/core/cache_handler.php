<?php

//-----HANDLES CACHING PAGES IN CONJUNCTION WITH SMARTY TEMPLATE CACHE-----//

class PAGEcache {
	 	
	//set vars 
	var $settings;
	var $pageUrl;
	var $area;
	var $CMS;
	
	public function cache(){
		
		//handle caching ie. smarty compile. clear cach every refresh if no caching	
		if(!$this->settings["cache"]){
			
			$this->clearCache();
			
		}	
		
		//handle actual caching
		if($this->settings["super_cache"] && $this->area != "admin"){
			
			$this->CMS->cache_dir = "system/lib/php/smarty/page_cache";
			
			$cached = $this->CMS->is_cached("main.tpl",$this->pageUrl);
			
			if($cached){
				$this->CMS->display("main.tpl",$this->pageUrl);
				exit;
			}
			
		}
		
	}
	
	public function clearCache(){
		
		//folders to clear
		$clearQueue = array("page_cache","compile","admin_compile");
		
		foreach($clearQueue as $folder){
			
			$path = "system/lib/php/smarty/".$folder;
			
			//get list of cache files
			$DIRreader			=	new DIRreader();
			$DIRreader->dir 	=	$path;
			$toClear			=	$DIRreader->getFiles();
			
			//delete files
			foreach($toClear as $file){
				unlink($path."/".$file);	
			}
			
		}
		
	}

}	
		
?>
