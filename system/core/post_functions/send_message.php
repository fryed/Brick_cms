<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO SEND A MESSAGE-----------//

$this->tableCheck();

//check default fields
$defaultArray = array("subject","name","email","content","table","action");
$new = false;
$content = "";
foreach($this->posts as $postName => $post){
	
	foreach($defaultArray as $default){
		if($postName == $default){
			$new = false;
			break;
		}else{
			$new = true;
		}
	}
	//if not default field add to content
	if($new){
		$content = $content."<p><strong>".$postName.":</strong><span>".$post."</span></p><br/>";
		unset($this->posts[$postName]);
	}
}

//complie content
$content				=	$content."<p><strong>body:</strong><span>".$this->posts["content"]."</span></p>";
$this->posts["content"] = 	$content;

//create table
$this->createTable();

//send message by email
$to 		= 	$this->siteInfoArray["email"];
$domain		=	str_replace("www.","",$_SERVER["SERVER_NAME"]);
$from 		= 	"noreply@".$domain;

if(isset($this->posts["subject"])) 
	$subject 	= 	$this->posts["subject"];
else
	$subject	=	"Message from ".$domain;

//get email template	
$message = file_get_contents("system/admin_templates/site-email.tpl");

//add in message contents
$message = str_replace("{\$domain}",$domain,$message);
$message = str_replace("{\$subject}",$this->posts["subject"],$message);
$message = str_replace("{\$name}",$this->posts["name"],$message);
$message = str_replace("{\$email}",$this->posts["email"],$message);
$message = str_replace("{\$content}",$content,$message);

//set headers
$headers  = "MIME-Version: 1.0rn"; 
$headers .= "Content-type: text/html; charset=iso-8859-1rn"; 
$headers .= "From: $from\r\n"; 

//send mail
//mail($to,$subject,$message,$headers); 

//set message
$_SESSION["messages"][] = "Message: Thankyou for your message.";
	
//go to new page
header("Location: ".$this->homePath.$this->pageUrl);
exit;	

?>