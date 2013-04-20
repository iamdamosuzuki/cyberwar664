<?php
// This document sets up the database connection and pulls variables into the database from config.php.

     include'static/config.php';     
    
    //setup the database connection
	try{
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}	catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
	}
	
	
	// creates authorization function for deleting and large admin tasks
	function delAuth($authorized){
		try{
			if (in_array($_SERVER['REMOTE_USER'],$authorized) == 0){
			echo "You do not have permission to perform this function.<br/>";
			echo "<br/>Return to <a href='index.php'>main page.</a><br/>";
			exit;
		}
		} catch(PDOException $ex){
		    echo 'Connection failed: ' . $ex->getMessage();
		}    
	}
	
	//fixes single quotation mark bug
	
	function quoteFixSing($cleanquotes){
		if(preg_match("/\\\'|\'/", $cleanquotes) == 1){
			$string = $cleanquotes;
			$pattern = ("/\\\'|\'/");
			$replacement = ("&#39;");
			$cleanquotes = preg_replace($pattern, $replacement, $string);
				}
			return $cleanquotes;
	}
	
	//fixes double quotation bug
	function quoteFixDoub($cleanquotes){
		if(preg_match('/\\\"/', $cleanquotes) == 1){
			$string = $cleanquotes;
			$pattern = ('/\\\"/');
			$replacement = ('"');
			$cleanquotes = preg_replace($pattern, $replacement, $string);
				}
		return $cleanquotes;
	}
		
?>