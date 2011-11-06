<?php 

//----------CALLED FROM POST HANDLER----------//
//----------FUNCTION TO CLEAR THE CACHE-----------//

//clear the cache
$CACHE = new PAGEcache();
$CACHE->clearCache();

$_SESSION["messages"][] = "Message: Cache cleared.";
	
//go to new page
header("Location: ".$this->homePath."/admin".$this->pageUrl);
exit;	

?>