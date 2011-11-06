<?php
//-----HANDLES PHP ERRORS-----//

class errorHandler {
	
	var $userType;
	var $logErrors;
	var $sendEmail;
	var $email;
	var $log;
	var $errors;

	public function errorHandler(){
		
		//set error array
		$this->errors = array();
		
		//set user type
		if(isset($_SESSION["userType"]))
			$this->userType = $_SESSION["userType"];
		
		//set error name array
		$this->errorNames = array(
			"E_ERROR",
			"E_WARNING",
			"E_PARSE",
			"E_NOTICE",
			"E_CORE_ERROR",
			"E_CORE_WARNING",
			"E_COMPILE_ERROR",
			"E_COMPILE_WARNING",
			"E_USER_ERROR",
			"E_USER_WARNING",
			"E_USER_NOTICE",
			"E_STRICT",
			"E_RECOVERABLE_ERROR"
		);
		
		//set error codes
		$this->errorCodes = array(
			"E_ERROR",
			"E_CORE_ERROR",
			"E_COMPILE_ERROR",
			"E_USER_ERROR",
			"E_RECOVERABLE_ERROR"
		);
		
		//set warning codes
		$this->warningCodes = array (
			"E_WARNING",
			"E_CORE_WARNING",
			"E_COMPILE_WARNING",
			"E_USER_WARNING",
			"E_PARSE",
			"E_STRICT"
		);
		
		//set notice codes
		$this->noticeCodes = array (
			"E_NOTICE",
			"E_USER_NOTICE"
		);
			
	}
	
	//custom error function
	public function customErrors($errorNo,$errorText,$errorFile,$errorLine,$errorContext){
			
		//set error vars	
		$this->errorNo 			= $errorNo;
		$this->errorText 		= $errorText;
		$this->errorFile 		= $errorFile;
		$this->errorLine 		= $errorLine;
		$this->errorContext 	= $errorContext;
		$this->errorCode		= $this->errorNames[$this->errorNo];
		$this->date 			= date("m/d/y");
		$this->time 			= date("H:i");
		$this->domain			= $_SERVER["SERVER_NAME"];
		
		//set error type
		$this->errorType = "";
		//check against errors
		foreach($this->errorCodes as $code){
			if($this->errorCode == $code)
				$this->errorType = "Error";
		}
		
		//check against warnings
		foreach($this->warningCodes as $code){
			if($this->errorCode == $code)
				$this->errorType = "Warning";
		}
		
		//check against notices
		foreach($this->noticeCodes as $code){
			if($this->errorCode == $code)
				$this->errorType = "Notice";
		}
		
		//set type of error to send to page
		if($this->userType == "developer")
			$this->detailedError();
		else
			$this->basicError();
			
		//if log errors then log
		if($this->logErrors)
			$this->logError();
			
		//if send error email notification unless developer
		if($this->sendEmail && $this->userType != "developer")
			$this->sendError();	
		
		return true;
	   
	}
	
	//show basic error to users
	public function basicError(){
			
		//set error
		$error = "<strong>".$this->errorType.":</strong> An error has occured.";
		
		//add to error array
		$this->errors[] = $error;
		
	}
	
	//show detailed error to developers
	public function detailedError(){
		
		//set error
		$error = "<strong>".$this->errorType.":</strong> ".$this->errorText." in ".$this->errorFile." on <strong>line ".$this->errorLine."</strong>.";
		
		//add to error array
		$this->errors[] = $error;
		
	}
	
	//build log error
	public function logError(){
		
		//get log contents
		$logContents = file_get_contents("error_log.txt");

		//build log message	
		$error = $this->errorType.": ".$this->time." ".$this->date." ".$this->errorText." in ".$this->errorFile." on line ".$this->errorLine.". Type of error: ".$this->errorCode."\n\n";
		
		//write message to file
		$logFile = "error_log.txt";
		$fh = fopen($logFile,"w") or die("Error: error opening log file.");
		fwrite($fh,$logContents.$error);
		fclose($fh);
		
	}
	
	//send error email
	public function sendError(){
		
		//set message
		$message = "
			<h2>An error has occured on '$this->domain'</h2>
			<p><b>Type of error: </b>$this->errorType</p>
			<p><b>Time of error: </b>$this->date $this->time</p>	 
			<p><b>Error code: </b>$this->errorCode</p>	 
			<p><b>Error message: </b>$this->errorText</p>	 
			<p><b>File: </b>$this->errorFile</p>	 
			<p><b>Line no: </b>$this->errorLine</p>	 
		";

		//send mail
		$to 		= $this->email;
		$subject 	= "Error message from ".$this->domain;
		$from 		= $this->domain;
		$headers  	= "MIME-Version: 1.0rn"; 
		$headers   .= "Content-type: text/html; charset=iso-8859-1rn"; 
		$headers   .= "From: $from\r\n"; 
		//mail($to,$subject,$message,$headers);
		
		//add message to errors
		$this->errors[] = "The developer has been informed.";
				
	}
	
	//return errors
	public function getErrors(){
		
		return $this->errors;	
	
	}
	
	//parse errors
	public function parseErrors($errors){
		
		//set parsed array
		$parsedErrors = "<div class='errors'>\n";
		
		//loop errors and add to parsed string
		foreach($errors as $error){
			
			$parsedErrors = $parsedErrors."<p>".$error."</p>\n";
			
		}
		
		$parsedErrors = $parsedErrors."</div>";
		
		//return errors
		return $parsedErrors;
		
	}
		
}

?>