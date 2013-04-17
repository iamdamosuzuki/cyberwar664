<?PHP
    // This document provides authorized users with option to delete articles.
    
    //includes 'util.php', which sets up database connection. 
    include 'util.php';
   
    // determines if user is authorized to perform task. 
    try{
	delAuth($authSuperUsers);
    } catch(PDOException $ex) {
    echo 'Connection failed: ' . $ex->getMessage();
    }
    
    
    //pulls id from "new_article" php 
    $id = $_GET['id'];


    //deletes selected entry from articles table	
    try{
    $sql = "DELETE FROM `articles` WHERE `id` = $id";
    $result = $db->query($sql);
    } catch(PDOException $ex) {
    echo 'Connection failed: ' . $ex->getMessage();
    }
    
    // deletes article from all authority (s) tables
    foreach($tables as $table){
	try{
	$sql = "DELETE FROM `$table` WHERE `article` = $id";
	$result = $db->query($sql);
	} catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
	}
    }
	
    //prints "entry deleted" statement
    echo "Entry deleted.<br/>Return to <a href='view_articles.php'>View Articles</a><br/>Return to <a href='index.php'>Main page</a>";

    //closes database connection. 
    $db = null;
	


?>

