<?php

//-----PROCESS UPLOADS-----//

class UPLOADhandler {
	 	
	//set vars 
	var $posts;
	var $maxFileSize;
	var $allowedImages;
	var $allowedFiles;
	var $uploadInfo;
	var $error;
	
	public function upload() {
	
		//set errors to none
		$error = false;

		//set allowed extensions
		switch($this->posts["table"]){
			
			case "downloads":
			$allowed = $this->allowedFiles;
			break;
			
			default:
			$allowed = $this->allowedImages;
			break;
			
		}
		
		//handle upload
		$upload = $_FILES["upload"];
		
		//add timestamp if download
		switch($this->posts["table"]){
			
			case "downloads":
			$time 		= date("d-M-y_H-i-s"); 
			$uploadName = $time."_".$upload["name"];
			break;

			default:
			$uploadName = $upload["name"];
			break;	
			
		}	
		
		//set target
		$target = "system/data/".$this->posts["table"]."/".$uploadName;
		
		if($upload["name"] != ""){
			
			//check for allowed ext
			$ext = substr(strrchr($upload["name"], "."), 1);
			foreach($allowed as $allow){
				if($ext == $allow){
					$error = false;
					if(isset($_SESSION["errors"]["not_supported"]))
						unset($_SESSION["errors"]["not_supported"]);
					break;
				}else{
					$error = true;
					$_SESSION["errors"]["not_supported"] = "Error: '".$ext."' files are not supported.";
				}	
			}
			
			//check if file already exists
			if(file_exists($target)){
				$error = true;
				$_SESSION["errors"][] = "Error: File named '".$upload["name"]."' already exists.";
			}	
	
			//check file size
			if($upload["size"] > $this->maxFileSize){
				$error = true;
				$_SESSION["errors"][] = "Error: '".$upload["name"]."' exceeds maximum file size.";	
			}
			
		}else{
			$error = true;
			$_SESSION["errors"][] = "Error: Please select a file for upload.";
		}
		
		//if no errors attempt upload
		if(!$error){
			if(move_uploaded_file($upload["tmp_name"],$target)){
				$_SESSION["messages"][] = "Message: The file '".$upload["name"]."' has been uploaded successfully.";
				
				//if successful
				switch($this->posts["table"]){
					
					case "downloads":
					$this->uploadInfo = array();
					$this->uploadInfo["name"]	= $uploadName;	
					break;	
					
					default:
					//get image size
					$this->uploadInfo = getimagesize($target);
					$this->uploadInfo["name"] 	= $upload["name"];
					$this->uploadInfo["width"]	= $this->uploadInfo[0];
					$this->uploadInfo["height"]	= $this->uploadInfo[1];
					break;
					
				}
				
			}else
				$_SESSION["errors"][] = "Error: There was an error uploading '".$upload["name"]."'. Please try again.";
		}
		
		$this->error = $error;
	
	}
	
	public function getErrors(){
		
		return $this->error;
		
	}
	
	public function getUploadInfo(){
		
		return $this->uploadInfo;
		
	}
	
}	
		
?>
