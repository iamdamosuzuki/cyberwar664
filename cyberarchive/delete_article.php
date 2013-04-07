<?PHP

<<<<<<< HEAD
include 'config.php';

//sets up database connection
	try{
	$db = new PDO($dsn, $user, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}	catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
}

//provides list of articles ordered by source and data	
	try{
	$sql = "SELECT * FROM `articles` ORDER BY `source`,`date`";
	$result=$db->query($sql);
	} catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
	}
	//$query = "SELECT * FROM `articles` ORDER BY `source`,`date`";
	//$result = mysql_query($query);

?>

=======
	$con = mysql_connect("50.63.105.14","cyberarchivedev","Archive@ccess5");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("cyberarchivedev");
	
	
	$query = "SELECT * FROM `articles` ORDER BY `source`,`date`";
	$result = mysql_query($query);

	if (!$result){
		die('Error: ' . mysql_error());			
	}
?>
>>>>>>> added all the files
