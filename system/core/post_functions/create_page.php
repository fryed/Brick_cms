<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO CREATE A PAGE-----------//

$this->tableCheck();

//switch tables
switch($this->posts["table"]){
		
	case "pages":
	//set url from uri
	$this->posts["url"] = $this->posts["uri"];	
	//set message
	$_SESSION["messages"][] = "Message: Page created.";
	break;	

	case "galleries":
	//set url from name
	$this->posts["url"] = "/galleries/".$this->posts["name"];
	//set message
	$_SESSION["messages"][] = "Message: Gallery created.";
	break;
	
	case "news":
	//set url from name
	$this->posts["url"] = "/news".$this->posts["uri"];
	//set message
	$_SESSION["messages"][] = "Message: News article created.";
	break;
	
	case "blog":
	//set url from name
	$this->posts["url"] = "/blog".$this->posts["uri"];
	//set message
	$_SESSION["messages"][] = "Message: Blog article created.";
	break;

	default:
	//set url from uri
	$this->posts["url"] = $this->posts["uri"];	
	//set message
	$_SESSION["messages"][] = "Message: Created successfully.";
	break;	
	
}

//check for duplicate urls
$this->duplicateCheck("url",$this->posts["url"]);

//create the table
$this->createTable();

//go to new page
header("Location: ".$this->homePath."/admin".$this->posts["url"]);
exit;	

?>