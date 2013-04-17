<?PHP
	// This document provides the user with a list of entered articles, hyperlinked to individual article entries.
	
	// includes util.php, which opens the database connection and includes config.php
	include 'util.php';
	echo "<body>";
	
	//Pulls lists of articles, ordered by source and date. 	
	try{
		$sql = "SELECT * FROM `articles` ORDER BY `source`,`date`";
	} catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
	}

	//Prints list of articles in table format	
	echo "<a href='index.php'>Return to main page</a><br/><br/>Sort by clicking on column heading.<br/>Sort multiple columns by clicking on additional headers while pressing Shift key.<br/><table id='myTable' class='tablesorter' cellspacing=1 border=1>";
	echo "<thead><tr><th>Title</th><th>Source</th><th>Date</th><th>URL</th></tr></thead>";
	echo "<tbody>";
	try{
		foreach ($db->query($sql) as $row){
		echo "<tr><td><a href='new_article.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></td><td>" . $row['source'] . "</td><td>" . $row['date'] . "</td><td>" . $row['url'] . "</td></tr>";
		}
	} catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
	}
	echo "</tbody>";
	echo "</table>";
	echo "</body>";
	
	//closes database connection
	$db = null;
?>