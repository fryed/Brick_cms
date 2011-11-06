<?php
//-----BRINGS BACK THE IMAGES FOR PAGES-----//

class IMGhandler extends DBconnect{
	 	
	//set vars 
	var $pageInfoArray;
	var $galleryArray;
	
	//return all images for page
	public function getImages() {
		
		//get gallery images
		if(isset($this->pageInfoArray["gallery_id"])){
		
			$galId 							= $this->pageInfoArray["gallery_id"];
			$params							= "WHERE belongs_to = '$galId'";
			$this->pageInfoArray["images"] 	= DBconnect::queryArray("*","images",$params);
			
		}
		
		//get page image
		$this->pageInfoArray["main_image"] = array();
		if(isset($this->pageInfoArray["image_id"])){
			if($this->pageInfoArray["image_id"] > -1){
					
				$imgId 								= $this->pageInfoArray["image_id"];
				$params								= "WHERE id = '$imgId'";
				$this->pageInfoArray["main_image"] 	= DBconnect::query("*","images",$params);
				
			}
		}
		
		return $this->pageInfoArray;
		
	}
	
	//return one image for gallery
	public function getImage(){
		
		//set var
		$galleryArray = array();
		
		//loop galleries
		foreach($this->galleryArray as $gallery){
			
			$galId 				= $gallery["id"];
			$params 			= "WHERE belongs_to = '$galId' LIMIT 1";
			$gallery["image"] 	= DBconnect::query("*","images",$params);
		
			$galleryArray[]		= $gallery;
			
		}
		
		return $galleryArray;
		
	}
	
}	
		
?>
