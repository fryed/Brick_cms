<?php

//-----SENDS OUT ALL THE MESSAGES TO THE PAGE-----//

class MSGhandler {
	 	
	//set vars 
	var $messages;
	
	public function MSGhandler() {

		$this->messages = array();
		$this->messages["messages"] = "";
		$this->messages["errors"] 	= "";
		
		//grab messages from session then reset
		if(isset($_SESSION["messages"])){
			if(is_array($_SESSION["messages"])){
				$this->messages["messages"] = implode("<br/>",$_SESSION["messages"]);
				unset($_SESSION["messages"]);
			}	
		}
		
		//grab errors from session then reset
		if(isset($_SESSION["errors"])){
			if(is_array($_SESSION["errors"])){
				$this->messages["errors"] = implode("<br/>",$_SESSION["errors"]);
				unset($_SESSION["errors"]);
			}	
		}
			
	}
	
	public function getMessages() {
		
		return $this->messages;
		
	}
	
}	
		
?>
