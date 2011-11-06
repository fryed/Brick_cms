<?php
/*
BASIC MODULE EXAMPLE
this is a basic module example. modules can be as basic or as complex
as you want. they are written as a php class and you can add as many
functions as you want, include new classes etc.
  
EXAMPLES OF HOW TO CONNECT TO THE DATABASE
all db functions use mysql queries. 
eg $rows and $params will be somthing like: 
 
$params = "WHERE id = 1"
$rows	= "row_name varchar(255)"
$values = "'val1','val2','val3'" 

google php mysql queries to learn more
  
CREATE TABLE
DBconnect::create($table,$rows);
each table will automatically have the id row added and set as primary.
 
ADD ROW TO TABLE
DBconnect::insert($table,$rows,$values); 
 
UPDATE ROW IN TABLE
DBconnect::update($table,$row,$value,$params);
 
DELETE ROW FROM TABLE
DBconnect::delete($table,$row,$value);

QUERY TABLE
DBconnect::query($row,$table,$params);
this will bring back an array is result is an array or string if not.

QUERY TABLE ARRAY
DBconnect::queryArray($row,$table,$params);
this will always produce an array even if there is only 1 result. 
*/

//-----EXAMPLE MODULE-----//

class example_module extends DBconnect {
		
	//THE VARS
	//these vars can be assessed anywhere in
	//the module by using $this->page["name"], or 
	//$this->site["keywords"] etc.
	var $module;
	var $site;
	var $menu;
	var $page;
	var $blog;
	var $news;
	var $brick;
	var $settings;
	
	//SETUP FUNCTION
	//this function is automatically called
	//depending on wether the module is already installed.
	//you should create all your tables within this function.
	public function setupModule(){
		
		//create the database table to save our information to.
		$rows = "
			title varchar(30) not null default 'enter title',
			content varchar(255) not null default 'enter content'
		";
		$success = DBconnect::create("example_module",$rows);
		
		//insert a row into our table
		$rows 	= "title,content";
		$values	= "'Example module title','Example module content'";	
		DBconnect::insert("example_module",$rows,$values);
		
		//if the function returns true the module
		//will be installed and setup will not run
		//again. if not setup will run on every page load.
		if($success)
			return true;
		
	}
	
	//RUN FUNCTION
	//this is the core of the module which you should 
	//put all the main functionality. feel free to add functions
	//and call them from here.
	public function runModule(){
		
		//set the modual template var to only send the
		//module information to a specific template
		//by default the information will be global.
		$this->module["template"] = "page.tpl";
		
		//get the info from the database to send to the page
		$params						= "";
		$moduleArray 				= DBconnect::query("*","example_module",$params);
		$this->module["title"]		= $moduleArray["title"];	
		$this->module["content"]	= $moduleArray["content"];	
		
		//send a static var to the page
		$this->module["foo"] = "bar";
		
		//check for post of our save button and run
		//the edit module function. this name must be unique
		//to every module.
		if(isset($_POST["save_example_module"])){
			$this->editModule();
		}
		
	}
	
	//EDIT MODULE
	//this is called when the user has clicked the save
	//module button set in example_module.admin.tpl
	public function editModule(){
		
		//update our table with the new information
		$title 		= $_POST["title"];
		$content 	= $_POST["content"];
		$params		= "WHERE id = 1";
		DBconnect::update("example_module","title",$title,$params);
		DBconnect::update("example_module","content",$content,$params);
		
		//send message to user and exit
		$_SESSION["messages"][] = "Message: Example module updated successfully.";
		
		//send user to module page
		header("Location: ".$this->module["url"]);
		exit;
		
	}
	
	//RETURN FUNCTION
	//this is called by the system to collect any
	//info that you want to send to the page.
	//anything put into the module array will be sent
	//to the page in the format {$module.module_name.value}
	public function returnModule(){
		
		return $this->module;
		
	}

}

?>