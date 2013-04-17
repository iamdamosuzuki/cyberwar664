<?PHP
    //This document displays a list of all rows in database that are linked to deleted article ids. The user is given the option to delete these rows, via clean_all_delete.php, linked below.
    
    //includes util.php, which sets up database connection. 
    include 'util.php';
    
    echo "<body>";
    //pulls and prints list of all rows that are linked to a deleted article id. 
    foreach($tables as $table){
	try{    
	    $sql = "SELECT * FROM $table WHERE $table.article NOT IN (SELECT `id` FROM `articles` WHERE 1)";
	    foreach ($db->query($sql) as $row){
		    echo $table . ":<br/>";
		    echo "there exists article id: '" . $row['article'] . "' in table '$table' at '$table' id: '" . $row['id'] . "' but there is no such article.<br/><br/>";
	    }
           } catch(PDOException $ex) {
        echo 'Connection failed: ' . $ex->getMessage();
        }
    }
    

    // pulls and prints list of all rows that exist in $table (authors, actors, attacks, etc.) but not in $table2 (authors_list, actors_list, attacks_list, etc)
    foreach($tables as $table){
	try{
	    $table2 = $table . "_list";
	    $sql = "SELECT * FROM $table WHERE $table.id NOT IN (SELECT `id` FROM `$table2` WHERE 1)";
	    foreach ($db->query($sql) as $row){
		echo $table2 . ": <br/>";
		echo "there exists '$table' id: '" . $row['id'] . "' while there is no such '$table2' id: '" . $row['id'] . "'<br/><br/>";
	    }
	} catch(PDOException $ex) {
	    echo 'Connection failed: ' . $ex->getMessage();
	}
    }
    
    //directs user to delete functionality, including "are you sure" prompt (confirmClean.js)
       try{
        echo "<br/><form action='clean_all_delete.php' method='post' onsubmit='return testConfirm();'><input type='submit' value='Clean this database'/></form>";
    } catch(PDOException $ex) {
        echo 'Connection failed: ' . $ex->getMessage();
    }
    
    //provides link back to main page    
    echo "Return to <a href='index.php'>main page.</a><br/>";
    echo "</body>";
    //closes database connection
	$db = null;

?>