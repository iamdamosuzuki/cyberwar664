<?PHP
    // This document deletes all lines in database tables that are linked to deleted article ids.
    
    //includes util.php, which sets up database connection. 
    include 'util.php';
        
    // deletes lines that are linked to deleted article ids. 
   echo "<body>";
    foreach($tables as $table){
	try{
	    $sql = "DELETE FROM $table WHERE $table.article NOT IN (SELECT `id` FROM `articles` WHERE 1);";
	    $db->query($sql);
	    echo $sql . "<br/>";
	}catch(PDOException $ex) {
	        echo 'Connection failed: ' . $ex->getMessage();
	}
    }
    
    // deletes every entry that exists in $table (authors, actors, attacks, etc), but not in $table2 (authors_list, actors_list, attacks_list, etc). 
    foreach($tables as $table){
	try{
	    $table2 = $table . "_list";
	    $sql = "DELETE FROM $table WHERE $table.id NOT IN (SELECT `id` FROM `$table2` WHERE 1)";
	    $db->query($sql);
	    echo $sql . "<br/>";
	} catch(PDOException $ex) {
	    echo 'Connection failed: ' . $ex->getMessage();
	}
    }
    
   //prints "table cleaned" message and offers links back to main page.     
   echo "</br></br>Done!";    
   echo "</br>Return to <a href='index.php'>main page.</a>";
   echo "</body>";
   //closes database connection
   $db = null;
?>