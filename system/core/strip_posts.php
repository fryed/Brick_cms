<?php

//-----PROCESSES POSTS BEFORE THEY ARE SENT TO FUNCTIONS-----//

class stripPosts {
	 	
	//set vars
	var $posts;
	var $get;
	var $area;
	
	//make post safe
	public function safePost() {

		foreach($this->posts as $key => $value){
			
			$this->posts[$key] = $this->makeSafe($key,$value);
			
		}
		
	}
	
	//make get safe
	public function safeGet() {

		foreach($this->get as $key => $value){
			
			$this->get[$key] = $this->makeSafe($key,$value);
			
		}

	}
	
	//encode posts
	public function encodePost($encode){
		
		if($encode){
			
			$this->posts = sha1($encode);
			return $this->posts;
			
		}else{
		
			foreach($this->posts as $key => $value){
				
				$this->posts[$key] = sha1($value);
				
			}
		
		}
		
	}
	
	public function makeSafe($key,$value){
		
		$value = str_replace("<script","",$value);
		$value = str_replace("/script>","",$value);
		$value = str_replace("<?php","",$value);
		$value = str_replace("?>","",$value);
		
		if($this->area != "admin"){
			$value = htmlspecialchars($value);
		}
		
		$value = mysql_real_escape_string($value);
		
		return $value;
		
	}
	
	public function getPost() {
		
		return $this->posts;
		
	}
	
	public function getGet() {
		
		return $this->get;
		
	}
	
}

?>