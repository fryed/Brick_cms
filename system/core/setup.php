<?php

//-----CHECKS FOR DATABASE AND INIT SETUP IF NOT FOUND-----//

class setup {
	 	
	//set vars 
	var $host;
	var $posts;
	var $username;
	var $password;
	var $database;
	var $setupErrors;
	
	//setup
	public function setup(){
		
		//set error var
		$this->setupErrors = array();
		
		//custom error handler
		$this->ERRORS = new errorHandler();
		$this->ERRORS->logErrors 	= true;
		$this->ERRORS->userType 	= "developer";
		$this->ERRORS->sendEmail 	= false;
		
		set_error_handler(array(&$this->ERRORS,"customErrors"));
	
	}
	
	//check for db
	public function checkSetup() {

		//set db host
		$this->host = $_SERVER["SERVER_NAME"];

		//check if can connect to DB host
		mysql_connect($this->host,$this->username,$this->password) or $this->showSetup();
		
		//check if can select database
		mysql_select_db($this->database) or $this->showSetup();

	}
	
	//show setup
	public function showSetup(){
			
		//new smarty instance for setup
		$SETUP = new Smarty();
		$SETUP->compile_check 	= 	false;
		$SETUP->caching 		= 	false;
		$SETUP->debugging 		= 	false;
		$SETUP->template_dir	= 	"system/admin_templates";
		$SETUP->compile_dir 	= 	"system/lib/php/smarty/compile";

		//get page url
		$url 		= explode("?",$_SERVER["REQUEST_URI"]);
		$this->url 	= $url[0];
	
		//make posts safe
		$this->posts = $this->validate($this->posts);

		//set setup stage var
		if(!isset($_SESSION["setup_stage"]))
			$_SESSION["setup_stage"] = 1;
			
		//check for add user
		if(isset($this->posts["DB_adduser"]) && !isset($this->setupErrors["blank_field"]))
			$this->addUser();
		
		//check create db
		if(isset($this->posts["DB_create"]) && !isset($this->setupErrors["blank_field"]))
			$this->setupDB();
		
		//catch all php errors
		$phpErrors = $this->ERRORS->getErrors();
	
		//loop errors and convert mysql user error to more readable error
		$i = 0;
		foreach($phpErrors as $error){
			$this->setupErrors[] = $error;
		}
		foreach($this->setupErrors as $error){
			$userError 		= strpos($error,"mysql_connect()");
			$dbError 		= strpos($error,"to database");
			$existsError 	= strpos($error,"database exists");
			if($userError !== false){
				$this->setupErrors[$i] = "Error: Access denied for user '".$this->username."' using password '".$this->password."'. Please check that the user exists and the password is correct."; 
				$_SESSION["setup_stage"] = 1;
			}elseif($dbError !== false){
				$this->setupErrors[$i] = "Error: User '".$this->username."' does not have sufficient privilages to create database '".$this->database."'. Please make sure that the user has 'CREATE' privilages.";	
			}elseif($existsError !== false){
				$this->setupErrors[$i] = $this->setupErrors[$i];
			}else{	
				unset($this->setupErrors[$i]);
			}
			$i++;
		}
		
		//set setup array
		$setupArray = array();
		$setupArray["step"] = $_SESSION["setup_stage"];
		$setupArray["errors"] = $this->setupErrors;
		
		//set home path
		$home = "http://".$_SERVER["SERVER_NAME"].str_replace("/index.php","",$_SERVER["SCRIPT_NAME"]);
		
		//assign smarty vars
		$SETUP->assign("setup"	,	$setupArray);
		$SETUP->assign("HOME"	,	$home);
		
		//display page
		$SETUP->display("setup.tpl");
		exit;
		
	}
	
	//add user
	public function addUser(){
		
		//add user to config file
		$config 				= array();
		$config["DBusername"] 	= $this->posts["DB_user"];
		$config["DBpassword"] 	= $this->posts["DB_pass"];
		$config["DBname"] 		= "";
		
		//write to file
		$this->writeConfig($config);
		
		//set session stage 2
		$_SESSION["setup_stage"] = 2;
		
		//reload page
		header("Location: http://".$this->host.$this->url);
		exit;
		
	}

	//create db
	public function setupDB(){
		
		//set db var
		$this->database = $this->posts["DB_name"];
			
		//create db
		mysql_query("CREATE DATABASE $this->database") or $this->setupErrors[] = mysql_error();
		
		//select database
		mysql_select_db($this->database) or die("Error: Could not select database. " . mysql_error());
		
		//if no errors save db to config and create db
		if(!$this->setupErrors){
			
			//add db to config file
			$config 				= array();
			$config["DBusername"] 	= $this->username;
			$config["DBpassword"] 	= $this->password;
			$config["DBname"] 		= $this->posts["DB_name"];
			
			//write to file
			$this->writeConfig($config);
			
			//include file to write db
			include_once("system/core/setup_database.php");
			
			//unset session stage
			unset($_SESSION["setup_stage"]);
			
			//reload page
			header("Location: http://".$this->host.$this->url);
			exit;

		}

	}
	
	//write the config file
	public function writeConfig($data){
			
		//turn data to string
		$confData = "<?php\n";
		foreach($data as $key => $value){
			$confData = $confData."$".$key." = \"".$value."\";\n";
		}
		$confData = $confData."?>";
		
		//write to config file
		$config = "system/config/config.php";
		$fh = fopen($config,"w") or die("Error: error opening config file.");
		fwrite($fh,$confData);
		fclose($fh);
		
	}
	
	//function to make posts safe and check for empties
	public function validate($posts){
		
		//loop posts
		$newPosts = array();
		foreach($posts as $key => $post){
			if($post == "")
				$this->setupErrors["blank_field"] = "Error: Please ensure all fields are completed.";
			$newPosts[$key] = addslashes($post);
		}

		return $newPosts;
		
	}
		
}	
		
?>
