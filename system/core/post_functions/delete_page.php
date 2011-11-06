<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO DELETE A PAGE-----------//

$this->tableCheck();
		
//delete main table
DBconnect::delete($this->posts["table"],"url",$this->pageUrl);

//switch tables
switch($this->posts["table"]){
	
	case "pages":
		
		//tables to check for data related to this page
		$checkTable = array("main_nav","header_nav","footer_nav");
		
		//delete from these tables too
		foreach($checkTable as $table){
			DBconnect::delete($table,"page_id",$this->posts["id"]);
		}

		//set message
		$_SESSION["messages"][] = "Message: Page deleted.";
		
		//go to
		$area = "dashboard";
		
	break;
	
	case "news":
		
		//set message
		$_SESSION["messages"][] = "Message: Article deleted.";
		
		//go to
		$area = "news";
		
	break;		

}

header("Location: ".$this->homePath."/admin/".$area);
exit;

?>