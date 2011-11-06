<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO DELETE MULTIPLE TABLES-----------//

$this->tableCheck();
		
$error = true;

//loop through post data
foreach($this->posts as $key => $value){
	
	if($key != "action" && $key != "table"){
		
		if($value == "on"){
			
			//get info from db
			//name of input must be prefixed with item. ie item0
			$key		= str_replace("item","",$key);
			$params		= "WHERE id = '$key'";
			$infoArray	= DBconnect::query("*",$this->posts["table"],$params);	
			
			//delete resource table from db
			DBconnect::delete($this->posts["table"],"id",$infoArray["id"]);
			
			switch($this->posts["table"]){
			
				case "galleries":
				$galId 		= $infoArray["id"];
				$params		= "WHERE belongs_to = '$galId'";
				$imageArray	= DBconnect::query("*","images",$params);
				if($imageArray){	
					foreach($imageArray as $image){
						
						//delete image table from db
						DBconnect::delete("images","id",$image["id"]);
						
						//delete actual image
						$src = substr($image["src"],1);
						if(file_exists($src))
							unlink($src);
					}
				}
				break;	
				
				case "blog_categories":
				//set blog item categories to general if in deleted cat
				$params	= "WHERE category_id = '$key'";
				DBconnect::update("blog","category_id","-1",$params);
				break;
				
				default:
				//delete actual resource if is set
				if(isset($infoArray["src"])){
					$this->posts["src"] = $infoArray["src"];
					$this->deleteResource();
				}	
				break;
				
			}	
				
			$error = false;	

		}else
			$error = true;

	}
	
}	

//set message
if($error)
	$_SESSION["errors"][] = "Error: Please select a resource to delete.";
else
	$_SESSION["messages"][] = "Message: Deleted successfully.";

header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;

?>