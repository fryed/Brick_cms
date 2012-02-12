<?php
//-----HANDLE CONNECTION TO THE DATABASE-----//
//-----ALL CLASSES WANTING TO READ OR WRITE TO DB SHOULD EXTEND THIS CLASS-----//

class DBconnect {
	 	
	//set vars
	var $host; 
	var $username;
	var $password;
	var $database;
	var $connection;
	
	//connect to database function
	public function connect() {
		
		//set db host
		$this->host = $_SERVER["SERVER_NAME"];

		//connect to DB host
		$this->connection = mysql_connect($this->host,$this->username,$this->password) or $_SESSION["errors"][] = "Error: Could not connect. " . mysql_error();

		//select database
		mysql_select_db($this->database) or $_SESSION["errors"][] = "Error: Could not select database. " . mysql_error();
		
	}
	
	//query database for single result
	public function query($row,$table,$params){
		
		$query 	= mysql_query("SELECT $row FROM $table $params") or $_SESSION["errors"][] = "Error: Could not select table. " . mysql_error();
		
		if($query){
			$result = $this->fetchArray($query);
		}else{
			$result = false;
		}
		
		if(!isset($result[1])){
			$result = $result[0];
		}
		
		return $result;
		
	}
	
	//query database for array
	public function queryArray($row,$table,$params){
		
		$query 	= mysql_query("SELECT $row FROM $table $params") or $_SESSION["errors"][] = "Error: Could not select table. " . mysql_error();;
		
		if($query){
			$result = $this->fetchArray($query);
		}else{
			$result = false;
		}
		
		if(!is_array($result))
			$result = array();
		
		return $result;
		
	}
	
	//handle array
	public function fetchArray($result){
		
		$resultArray = array();
		
		while($row = mysql_fetch_array($result)){
			$resultArray[] = $row;				
		}
		
		$i=0;
		while($i < count($resultArray)){
			$s = 0;
			while($s < count($resultArray[$i])){
				unset($resultArray[$i][$s]);
				$s++;
			}
			$i++;
		}
		
		if(!isset($resultArray[0])){
			$resultArray = false;
		}
		
		return $resultArray;
		
	}
	
	//insert table and add values
	public function insert($table,$rows,$values){
		
		mysql_query("INSERT INTO $table ($rows) VALUES ($values)") or $_SESSION["errors"][] = "Error: Could not insert data. " . mysql_error();
		
		return true;
		
	}
	
	//update table in  database
	public function update($table,$row,$value,$params){
		
		mysql_query("UPDATE $table SET $row='$value' $params") or $_SESSION["errors"][] = "Error: Could not update data. " . mysql_error();
		
		return true;
		
	}
	
	//delete row from database
	public function delete($table,$row,$value){
		
		mysql_query("DELETE FROM $table WHERE $row='$value'") or $_SESSION["errors"][] = "Error: Could not delete data. " . mysql_error();
		
		return true;
		
	}
	
	//delete all rows from database
	public function deleteAll($table){
		
		mysql_query("DELETE FROM $table") or $_SESSION["errors"][] = "Error: Could not delete data. " . mysql_error();
		
		return true;
		
	}
	
	//add table to database
	public function create($table,$rows){

		mysql_query("CREATE TABLE $table (id int not null auto_increment,primary key(id),$rows)") or $_SESSION["errors"][] = "Error: Could not create table. " . mysql_error();
		
		return true;
		
	}
	
	//drop table from database
	public function drop($table){

		mysql_query("DROP TABLE $table") or $_SESSION["errors"][] = "Error: Error removing table. " . mysql_error();
		
		return true;
		
	}
	
	//close the db connection
	public function close(){
				
		mysql_close($this->connection);	
		
	}
		
}

?>
