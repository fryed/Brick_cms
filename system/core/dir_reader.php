<?php

//-----CLASS TO READ DIRECTORIES AND RETURN A LIST OF FILES OR FOLDERS-----//

class DIRreader {
	 	
	//set vars 
	var $dir;
	var $ignore;
	var $folders;
	
	public function getFiles() {

		$files = array();

		$handler = opendir($this->dir);
	
		//read directory
		while($file = readdir($handler)){
			if($file != "." && $file != ".."){
				if($this->folders){
					$files[] = $file;	
				}else{
					if(!is_dir($this->dir."/".$file))
						$files[] = $file;
				}		
			}	
		}

		closedir($handler);
		
		//strip out ignored files
		$i = 0;
		if($this->ignore){
			
			foreach($files as $file){
				
				if(is_array($this->ignore)){
					foreach($this->ignore as $ignore){
						if($file == $ignore)
							unset($files[$i]);
					}
				}else{
					if($file == $this->ignore)
						unset($files[$i]);
				}
				$i++;
			}
			
		}

		return $files;
		
	}
	
}	
		
?>
