<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO CREATE A SINGLE TABLE-----------//

$this->tableCheck();

//create table
$this->createTable();

//set message
switch($this->posts["table"]){
	
	case "main_nav":
	//set message
	$_SESSION["messages"][] = "Message: Menu updated successfully.";
	break;
	
	case "header_nav":
	//set message
	$_SESSION["messages"][] = "Message: Menu updated successfully.";
	break;
	
	case "footer_nav":
	//set message
	$_SESSION["messages"][] = "Message: Menu updated successfully.";
	break;
	
	case "links":
	//set message
	$_SESSION["messages"][] = "Message: Link added successfully.";
	break;
	
	case "blog_comments":
	//set message
	$_SESSION["messages"][] = "Message: Thankyou for your comment.";
	break;
	
	default:
	$_SESSION["messages"][] = "Message: Created successfully.";
	
}

//go to correct page
switch($this->posts["table"]){
	
	case "blog_comments":
	//go to new page
	header("Location: ".$this->homePath.$this->pageUrl);
	break;
	
	default:		
	//go to new page
	header("Location: ".$this->homePath."/admin".$this->pageUrl);
		
}

//exit so messages can be read
exit;		

?>