<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO UPDATE THE MENU-----------//

$this->tableCheck();
		
//loop through post data and save
foreach($this->posts as $key => $value){
	
	if($key != "action" && $key != "table"){
		
		//if delete is ticked
		if($value == "on"){
			
			//set key
			$key = str_replace("item","",$key);
			
			//delete from menu
			DBconnect::delete($this->posts["table"],"id",$key);
			
		}else{
			
			//update menu item
			$keyArray 	= explode("-",$key);
			if(is_array($keyArray)){	
				
				$key		= $keyArray[0];
				$id			= $keyArray[1];
						
				//handle updating url of page
				if($key == "parent"){
					
					//get section info
					$sectionInfo	= explode(">",$value);
					$sectionUrl  	= $sectionInfo[0];
					$value			= $sectionInfo[1];		 
					
					//get menu info
					$params 	=	"WHERE id ='".$id."'";	
					$menuItem 	= 	DBconnect::query("page_id",$this->posts["table"],$params);
					
					//get section
					$pageId 	=	$menuItem["page_id"];
					$params 	=	"WHERE id ='".$pageId."'";	
					$pageUri 	= 	DBconnect::query("uri","pages",$params);
						
					//build new url
					$newUrl = $sectionUrl.$pageUri["uri"];
					
					//save to pages table
					DBconnect::update("pages","url",$newUrl,$params);
					DBconnect::update("pages","parent",$value,$params);
					DBconnect::update("pages","section",$sectionUrl,$params);
	
				}
				
				$params = "WHERE id='".$id."'";
				DBconnect::update($this->posts["table"],$key,$value,$params);
				
			}
			
		}	
			
	}
	
}

//set message
$_SESSION["messages"][] = "Message: Menu updated.";
header("Location: ".$this->homePath."/admin");
exit;

?>