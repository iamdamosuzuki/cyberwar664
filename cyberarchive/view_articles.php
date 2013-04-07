<?PHP

	include 'config.php';
//sets up database connection 	
	try{
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}	catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
	}
//provides lists of articles, ordered by source and date. 	
	try{
		$sql = "SELECT * FROM `articles` ORDER BY `source`,`date`";
	} catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
	}

	echo "<a href='index.php'>Return to main page</a><br/><br/><table border=1>";
//prints list of articles in table format	
	try{
		foreach ($db->query($sql) as $row){
		echo "<tr><td><a href='new_article.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></td><td>" . $row['source'] . "</td><td>" . $row['date'] . "</td><td>" . $row['url'] . "</td></tr>";
		}
	} catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();


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

	echo "<a href='index.php'>Return to main page</a><br/><br/><table border=1>";
	while($row = mysql_fetch_array($result)){
		echo "<tr><td><a href='new_article.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></td><td>" . $row['source'] . "</td><td>" . $row['date'] . "</td><td>" . $row['url'] . "</td></tr>";

	}
	echo "</table>";
?>