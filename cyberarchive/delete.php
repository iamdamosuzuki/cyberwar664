<?PHP

	include'config.php';
	$table = $_GET['table'];
	$id = $_GET['id'];

//sets up database connection
	try{
	$db = new PDO($dsn, $user, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}	catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
}

//Deletes selected entry and prints corresponding "deleted" verification message. 	
	try{
	$sql = "DELETE FROM `$table` WHERE `id` = $id";
	$result = $db->query($sql);
	} catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
	}
	
	echo "Entry deleted. Return to <a href='authority.php?table=$table'>edit $table</a>";
	
	$db = null;

	$table = $_GET['table'];
	$id = $_GET['id'];


	$con = mysql_connect("50.63.105.14","cyberarchivedev","Archive@ccess5");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("cyberarchivedev");
	
	
	$query = "DELETE FROM `$table` WHERE `id` = $id";
	$result = mysql_query($query);
	if (!$result){
		die('Error: ' . mysql_error());			
	}
	
	
	echo "entry delted. return to <a href='authority.php?table=$table'>edit $table</a>";
	
	mysql_close($con);
>>>>>>> added all the files
?>