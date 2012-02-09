<?php
//-----HANDLES ALL LOGIN ATTEMPTS-----//

class handleLogin extends DBconnect {
	 	
	//set vars
	var $homePath;
	var $posts; 
	var $username;
	var $password;
	var $logStatus;
	
	//handle login/logout
	public function logCheck() {
		
		//if banned send to guard dog
		if(isset($_SESSION["banned"])){
			if($this->logStatus != "guardDog")
				$this->guardDog();
		}
		
		//check for login attempt
		$logInAttempt = false;
		if(isset($this->posts["action"])){
			if($this->posts["action"] == "LogIn")
				$logInAttempt = true;
		}

		//check for username and password
		if((isset($this->posts["username"]) || isset($this->posts["password"])) && $logInAttempt){
			
			//count attempts (backwards for messages)
			if(isset($_SESSION["attempts"]))
				$_SESSION["attempts"] --;
			else
				$_SESSION["attempts"] = 3;
				
			//if over 3 attampts send to guard dog and ban
			if($_SESSION["attempts"] < 1)
				$this->guardDog();
				
			//get details
			$this->username = $this->posts["username"];
			$this->password = sha1($this->posts["password"]);
		
			$params			=	"WHERE username = '$this->username'";
			$userArray		= 	DBconnect::query("*","users",$params);
			
			if(!empty($userArray)){
	
				//if password matches login else back to login page
				if($userArray["password"] == $this->password){
					$_SESSION["messages"][] = "Welcome ".$this->username."."; 
					$_SESSION["user"] 		= $this->username;
					$_SESSION["userType"] 	= $userArray["type"];
					$this->login();
				}else{
					$_SESSION["errors"][] = "Error: password incorrect. ".$_SESSION["attempts"]." attempt's remaining.";
					$this->reject();
				}
				
			}else{
				$_SESSION["errors"][] = "Error: username '".$this->username."' does not exist. ".$_SESSION["attempts"]." attempt's remaining.";
				$this->reject();
			}
			
		}else{
			
			//send back to login page if not logged in and not already on login page
			if(isset($_SESSION["loggedIn"])){
				if($_SESSION["loggedIn"] != true){
					if($this->logStatus != "enter")
						$this->reject();
				}
			}else{
				$this->reject();
			}
				
			//check for logout
			if($this->logStatus == "leave")
				$this->logout();	
				
		}	
		
	}
	
	//login
	public function login() {
		
		//for security
		session_regenerate_id();
		
		$_SESSION["loggedIn"] = true;
		unset($_SESSION["attempts"]);
		header("Location: ".$this->homePath."/admin/dashboard");
		exit;
		
	}
	
	//logout
	public function logout() {
		
		//clear the cache
		$CACHE = new PAGEcache();
		$CACHE->clearCache();
		
		unset($_SESSION["loggedIn"]);
		session_destroy();
		header("Location: ".$this->homePath."/");
		exit;
		
	}
	
	//reject
	public function reject() {
		
		//if banned always send to guard dog
		if($this->logStatus != "guardDog"){
			
			//for security
			session_regenerate_id();
			
			$_SESSION["loggedIn"] = false;
			header("Location: ".$this->homePath."/admin/login");
			exit;
			
		}
		
	}
	
	public function guardDog() {
		
		//for security
		session_regenerate_id();
		
		$_SESSION["loggedIn"] 	= false;
		$_SESSION["banned"]		= true;
		header("Location: ".$this->homePath."/admin/guarddog");
		exit;
		
	}
	
	public function getUser(){
		
		if(isset($_SESSION["user"]))
			return $_SESSION["user"];
		
	}
	
	public function getUserType(){
		
		if(isset($_SESSION["userType"]))
			return $_SESSION["userType"];
		
	}
	
}

?>
