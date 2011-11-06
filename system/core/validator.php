<?php

//-----VALIDATE POSTS-----//

class validator {
	 	
	//set vars
	var $posts;
	var $pageUrl;
	var $homePath;
	var $errors;
	var $area;
	
	//validate posts
	public function validatePosts() {
			
		//default no errors
		$this->errors = false;	
		
		//empties array
		$checkEmpty 	= array("name","email","email_address","title","url","uri");

		//email array
		$checkEmail		= array("email","emailAddress","email-address","email_address","company_email","dev_email");
		
		//url array
		$checkUrl		= array("uri","url","link","module_name","brick_name");
		
		//number array
		$checkNumber	= array("number","tel","telephone","tel_no","mobile","telephone_number","company_tel","max_news","max_search","max_blog","max_latest_blog","max_latest_news");
		
		if(!isset($this->posts["action"]))
			$this->posts["action"] = false;
		
		if($this->area == "admin" || $this->posts["action"] == "send message"){

			foreach($this->posts as $key => $value){
					
				//check empties
				foreach($checkEmpty as $name){
					if($name == $key)
						$this->checkEmpty($key,$value);
				}
				
				//check eamils
				foreach($checkEmail as $name){
					if($name == $key)
						$this->checkEmail($key,$value);
				}
				
				//check numbers
				foreach($checkNumber as $name){
					if($name == $key)
						$this->checkNumber($key,$value);
				}
				
				//check urls
				foreach($checkUrl as $name){
					if($name == $key)
						$this->checkUrl($key,$value);
				}
	
			}
		
		}
		
		//if errors exit and reload page
		if($this->errors){
			switch($this->area){
					
				case "admin":
					header("Location: ".$this->homePath."/".$this->area.$this->pageUrl);
				break;
				
				default:
					header("Location: ".$this->homePath.$this->pageUrl);	
				break;	
			
			}
			exit;
		}else{
			
			if($this->posts["action"] == false)
				unset($this->posts["action"]);	
			
			return $this->posts;
			
		}
		
	}
	
	//check for empty required fields
	public function checkEmpty($key,$value){
		
		if($value == ""){
			$_SESSION["errors"][] = "Error: '".$key."' is a required field.";
			$this->errors = true;	
		}
		
	}
	
	//check for valid number
	public function checkNumber($key,$value){
		
		$value = str_replace(" ","",$value);
		$isNumber = is_numeric($value);
		if(!$isNumber){
			$_SESSION["errors"][] = "Error: '".$value."' is not a valid number.";
			$this->errors = true;	
		}
		
	}
	
	//check for invalid urls and sanitize
	public function checkUrl($key,$value){

		switch($key){
			
			case "link":
				$link = filter_input(INPUT_POST,$key,FILTER_SANITIZE_URL);
				$this->posts[$key] = $link;
			break;
			
			case "uri":
				//replace spaces with underscores
				$uri 	= 	str_replace(" ","_",$value);
				//only allow - _ a-z A-Z 0-9
				$uri 	= 	preg_replace("~[^\-_a-zA-Z0-9]+~","",$uri);
				//add forward slash to beginning
				$uri	=	"/".$uri;
				$this->posts[$key] = $uri;
			break;
			
			case "url":
			case "module_name":
			case "brick_name":
				//replace spaces with underscores
				$url 	= 	str_replace(" ","_",$value);
				//only allow / - _ a-z A-Z 0-9
				$url 	= 	preg_replace("~[^/\-_a-zA-Z0-9]+~","",$url);
				$this->posts[$key] = $url;
			break;
			
		}
			
	}
	
	//check for valid email address
	public function checkEmail($key,$value){
		
		$isValid = $this->validEmail($value);
		if(!$isValid){
			$_SESSION["errors"][] = "Error: '".$value."' is not a valid email address.";
			$this->errors = true;	
		}
		
	}
	
	public function validEmail($email){
		
		$isValid = true;
		$atIndex = strrpos($email, "@");
		if(is_bool($atIndex) && !$atIndex){
			$isValid = false;
		}else{
			$domain = substr($email, $atIndex+1);
			$local = substr($email, 0, $atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);
			if($localLen < 1 || $localLen > 64){
				// local part length exceeded
				$isValid = false;
			}else if($domainLen < 1 || $domainLen > 255){
				// domain part length exceeded
				$isValid = false;
			}else if($local[0] == '.' || $local[$localLen-1] == '.'){
				// local part starts or ends with '.'
				$isValid = false;
			}else if(preg_match('/\\.\\./', $local)){
				// local part has two consecutive dots
				$isValid = false;
			}else if(!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)){
				// character not valid in domain part
				$isValid = false;
			}else if(preg_match('/\\.\\./', $domain)){
				// domain part has two consecutive dots
				$isValid = false;
			}else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',str_replace("\\\\","",$local))){
				// character not valid in local part unless 
				// local part is quoted
				if (!preg_match('/^"(\\\\"|[^"])+"$/',str_replace("\\\\","",$local))){
	            	$isValid = false;
				}
			}
			if($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))){
				// domain not found in DNS
				$isValid = false;
			}
		}
	   	return $isValid;
	}
	
}

?>