<?php
//-----BRINGS BACK A LIST OF PAGES-----//

class pageLister extends DBconnect{
	 	
	//set vars 
	var $pages;
	var $table;
	var $maxNo;
	var $blogMenu;
	var $newsMenu;
	var $posts;
	var $settingsArray;
	var $paging;
	
	public function getPages() {
		
		//get params
		$params = $this->getParams();
		
		//get pages from db
		$pageArray 		= DBconnect::queryArray("*","$this->table",$params);
		$this->pages 	= array();

		//loop pages and get page image if set
		$i = 0;
		foreach($pageArray as $page){
			
			//skip '/blog' and '/news'
			if($page["url"] != "/news" && $page["url"] != "/blog"){
				
				//only bring max no back	
				if($this->maxNo){
					if($i == $this->maxNo) break;
				}		
			
				$page["main_image"] = array();
				
				//get page image
				if(isset($page["image_id"])){
					if($page["image_id"] > -1){
						
						$imgId 				= $page["image_id"];
						$params				= "WHERE id = '$imgId'";
						$page["main_image"] = DBconnect::query("*","images",$params);
						
					}
				}
				
				$this->pages[] = $page;
				
				$i++;
			
			}
		
		}
		
		//handle blog menu list
		if($this->blogMenu)
			$this->pages = $this->buildBlogMenu();

		//handle news menu list
		if($this->newsMenu)
			$this->pages = $this->buildNewsMenu();
		
		//send back to page	
		return $this->pages;
		
	}
	
	//work out the amount of pages to show etc
	public function getParams(){
		
		//set limit to items brought back paging true
		if($this->paging){
			
			//set init limits	
			$limit1 = 0;
			
			switch($this->table){
				case "pages":
				$limit2 = $this->settingsArray["max_pages"];
				break;	
				
				case "blog":
				$limit2 = $this->settingsArray["max_blog"];
				break;	
				
				case "news":
				$limit2 = $this->settingsArray["max_news"];
				break;
			}
			
			//check for posts from paging
			if(isset($this->posts["action"])){
				switch($this->posts["action"]){
					case "next":		
					$limit1 = $this->posts["limit1"]+$limit2;
					$limit2	= $this->posts["limit2"]+$limit2;
					break;
					
					case "prev":
					$limit1 = $this->posts["limit1"]-$limit2;	
					$limit2 = $this->posts["limit2"]-$limit2;
					break;
				}
			}
			
			//work out which buttons to show
			$prev = true;
			$next = true;
			if($limit1 == 0)
				$prev 	= false;
			$isNext = DBconnect::query("id","$this->table","LIMIT $limit2,$limit2");
			if(!is_array($isNext))
				$next = false;
				
			//send limits to settings array
			$this->settingsArray["paging"]				= array();	
			$this->settingsArray["paging"]["limit1"] 	= $limit1; 
			$this->settingsArray["paging"]["limit2"] 	= $limit2; 
			$this->settingsArray["paging"]["next"] 		= $next; 
			$this->settingsArray["paging"]["prev"] 		= $prev; 
			
			//set params
			$params = "LIMIT $limit1,$limit2";
			
		}else{
			$params = "";
		}
			
		return $params;	
		
	}
		
	//build up blog menu
	public function buildBlogMenu(){
	
		//get blog cats from db
		$catArray = DBconnect::queryArray("*","blog_categories","");
			
		//set blog menu var
		$blogMenu = array();
		
		//loop cats and add pages to correct place
		$i = 0;
		foreach($catArray as $cat){
			
			//build menu
			$blogMenu[$i]			= array();
			$blogMenu[$i]["name"] 	= $cat["name"];
			$blogMenu[$i]["pages"] 	= array();
			
			//loop pages and assign to cat if cat id matches id
			foreach($this->pages as $page){
				
				if($page["category_id"] == $cat["id"])
					$blogMenu[$i]["pages"][] = $page;
				
			}

			$i++;
			
		}

		//send blog menu to page array
		return $blogMenu;
		
	}	
	
	public function buildNewsMenu(){
		
		//set cat array
		$catArray = array();

		//get blog cats from db
		$createdArray = DBconnect::queryArray("created","news","");
		
		//parse cat array
		foreach($createdArray as $cat){
			$cat 		= strtotime($cat["created"]);
			$cat 		= date("F Y",$cat);
			$catArray[] = $cat;	
		}
		
		//strip duplicates from cat array
		$catArray = array_unique($catArray);
		
		//set array
		$newsMenu = array();
		
		//loop cats and build menu
		$i = 0;
		foreach($catArray as $cat){
			
			//build menu
			$newsMenu[$i]			= array();
			$newsMenu[$i]["name"] 	= $cat;
			$newsMenu[$i]["pages"] 	= array();
			
			//loop pages and assign to cat if cat matches created
			foreach($this->pages as $page){
				
				$created = strtotime($page["created"]);
				$created = date("F Y",$created);
				
				if($created == $cat)
					$newsMenu[$i]["pages"][] = $page;
				
			}

			$i++;

		}
		
		//send to page array
		return $newsMenu;
		
	}
	
	public function getSettings(){
		
		return $this->settingsArray;
		
	}
	
}	
		
?>
