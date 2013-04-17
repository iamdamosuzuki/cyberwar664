<?php
// This document sets up the database connection and pulls variables into the database from config.php.

     include'static/config.php';
     echo "<link rel='stylesheet' type='text/css' media='all' href='static/cyberarchive_back.css'/>";
     echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>";
     echo "<script type='text/javascript' src='static/moveFunction2.js'></script>";
     echo "<script type='text/javascript' src='static/confirmDel.js'></script>";
     echo "<script type='text/javascript' src='static/confirmClean.js'></script>";
     
     // jquery code for tablesorter function called in view_articles.php
     echo "<script type='text/javascript' src='static/jquery.tablesorter/jquery-latest.js'></script>";
     echo "<script type='text/javascript' src='static/jquery.tablesorter/jquery.tablesorter.js'></script>";
     echo "<script type='text/javascript' src='static/sortTable.js'></script>";

     
    
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