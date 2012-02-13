<?php 
//-----ALL POSTS COME THROUGH HERE AND ARE PROCESSED BY THE VAL OF THE SUBMIT BUTTON USED TO POST-----//

class postHandler extends DBconnect {
	 	
	//set vars 
	var $posts;
	var $pageUrl;
	var $homePath;
	var $settingsArray;
	var $siteInfoArray;
	
	//run main function
	public function handlePosts() {
		
		//check for posts
		if($this->posts && isset($this->posts["action"])){

			//work out the action
			switch ($this->posts["action"]) {
					
				case "search":
				$this->search();	
				break;	
			
				case "save changes":
				$this->editPage();
				break;
				
				case "create page":
				case "create article":
				case "create gallery":
				$this->createPage();
				break;
				
				case "delete page":
				case "delete article":
				$this->deletePage();
				break;

				case "update menu":
				$this->updateMenu();
				break;
				
				case "add to menu":
				case "create":
				case "add link":
				case "add comment":
				$this->create();
				break;
				
				case "add feature":
				$this->addFeature();
				break;
				
				case "edit feature":
				$this->editFeature();
				break;
				
				case "upload":
				case "upload logo":
				$this->upload();
				break;
				
				case "delete selected":
				case "delete logo":
				$this->deleteMultiple();
				break;
				
				case "add user":
				$this->addUser();
				break;
				
				case "edit user":
				$this->editUser();
				break;
				
				case "delete":
				$this->delete();
				break;
				
				case "save":
				$this->edit();	
				break;

				case "clear cache":
				$this->clearCache();	
				break;
				
				case "send message":
				$this->sendMessage();	
				break;		

				case "create module":
				$this->createModule();	
				break;
				
				case "uninstall selected":
				$this->uninstallModule();
				break;
				
				case "install module":
				$this->installModule();
				break;
				
				case "toggle build mode":
				$this->toggleBuildMode();
				break;
				
				default:
				return;
					
			}	

		}
			
	}
	
//--------------------PAGE FUNCTIONS--------------------//	
	
	//edit page
	public function editPage() {
		
		include("system/core/post_functions/edit_page.php");
		
	}
	
	//delete page
	public function deletePage(){
		
		include("system/core/post_functions/delete_page.php");
		
	}
	
	//create page
	public function createPage() {
		
		include("system/core/post_functions/create_page.php");

	}
	
//--------------------USER FUNCTIONS--------------------//	
	
	//add a user
	public function addUser() {
		
		include("system/core/post_functions/create_user.php");

	}
	
	//edit a user
	public function editUser() {
		
		include("system/core/post_functions/edit_user.php");

	}
	
//--------------------MENU FUNCTIONS--------------------//	
	
	public function updateMenu(){
		
		include("system/core/post_functions/update_menu.php");
	
	}
	
//--------------------FEATURE FUNCTIONS--------------------//	
	
	//add a feature
	public function addFeature(){
		
		include("system/core/post_functions/create_feature.php");
	
	}
	
	//edit a feature
	public function editFeature(){
		
		include("system/core/post_functions/edit_feature.php");
	
	}
	
//--------------------UPLOAD FUNCTIONS--------------------//
	
	public function upload() {
		
		include("system/core/post_functions/upload.php");
			
	}
	
	
//--------------------MODULE FUNCTIONS--------------------//

	//create a module
	public function createModule() {
		
		include("system/core/post_functions/create_module.php");
			
	}
	
	//uninstall modules
	public function uninstallModule() {

		include("system/core/post_functions/uninstall_module.php");
			
	}
	
	//install modules
	public function installModule() {

		include("system/core/post_functions/install_module.php");
			
	}
	
	//toggle build mode
	public function toggleBuildMode() {

		include("system/core/post_functions/toggle_build_mode.php");
			
	}
	
//--------------------OTHER FUNCTIONS--------------------//
	
	//clear the cache
	public function clearCache(){
		
		include("system/core/post_functions/clear_cache.php");
		
	}
	
	//search main tables
	public function search(){
		
		include("system/core/post_functions/search.php");
		
	}
	
	//send a message
	public function sendMessage(){
		
		include("system/core/post_functions/send_message.php");
		
	}
	
//--------------------GENERIC FUNCTIONS--------------------//	
	
	//delete single
	public function delete(){
		
		include("system/core/post_functions/delete_single.php");
		
	}
	
	//create single
	public function create(){
		
		include("system/core/post_functions/create_single.php");
		
	}
	
	//edit
	public function edit(){
		
		include("system/core/post_functions/edit.php");
		
	}
	
	//delete multiple
	public function deleteMultiple(){
		
		include("system/core/post_functions/delete_multiple.php");
		
	}
	
//--------------------FUNCTIONS USED BY THE OTHERS IN THIS CLASS--------------------//	
	
	public function createTable(){
		
		$keys 	= array();
		$values	= array();
		
		//loop through post data and create vars
		foreach($this->posts as $key => $value){
			
			if($key != "table" && $key != "action"){
				$keys[] 	= $key;
				$values[]	= "'$value'";
			}
			
		}
		
		$keys 	= implode(",",$keys);
		$values = implode(",",$values);
		
		//add table
		DBconnect::insert($this->posts["table"],$keys,$values);
		
	}
	
	public function updateTable($params){
		
		//loop through post data and save
		foreach($this->posts as $key => $value){
			
			if($key != "table" && $key != "action" && $key != "id")	
				DBconnect::update($this->posts["table"],$key,$value,$params);

		}
		//die();
		
	}
	
	public function deleteResource(){
		
		//delete resources if set
		if(isset($this->posts["src"])){
			$src = $this->posts["src"];
			if(file_exists($src))
				unlink($src);
		}elseif(isset($this->posts["img_src"])){
			$src = $this->posts["img_src"];
			if(file_exists($src))
				unlink($src);
		}
		
	}
	
	public function tableCheck(){
		
		//remind to add hidden table field
		if(!$this->posts["table"])
			die("Error: Please include '&lt;input type='hidden' name='table' value='insert table name'/&gt;");
			
	}
	
	public function duplicateCheck($row,$value){
		
		$params = "WHERE $row = '$value'";
		$check 	= DBconnect::query("*",$this->posts["table"],$params);
		
		if($check){
			$_SESSION["errors"][] = "Error: ".$row." '".$value."' already exists.";
			header("Location: ".$this->homePath."/admin".$this->pageUrl);
			exit;
		}
		
	}
			
}	

?>