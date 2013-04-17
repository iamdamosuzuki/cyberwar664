<?PHP
    //includes util.php, which sets up database connection and includes list of authorized users
    include 'util.php';
    
	// determines if user is authorized to perform task
    	try{
        	delAuth($authSuperUsers);
        } catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
		}
        
	//allows authorized users to clean database                
        echo "<br/><form action='clean_all.php' method='post'><input type='submit' value='Clean the database'/></form><br>";
	echo "<br/><form action='mergeAuth.php' method='post'><input type='submit' value='Merge Authority Data'/></form>";



    //closes database connection. 
    $db = null;
?>