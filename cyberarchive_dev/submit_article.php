<?PHP
	//This document submits new and edited article data. 
	
	// includes util.php, which sets up database connection
	include 'util.php';

	
	//For existing articles, uses id to query 'articles' table with appropriate id, creates parameters for update of article information. 
	if (isset($_GET['id'])){
		try{
			$sql = "UPDATE `articles` SET `title` = '". $_POST['title'] . "',`date`='" . $_POST['date'] . "',`source`='" . $_POST['source'] . "',`url`='" . $_POST['url'] . "',`text`='" . $_POST['text'] . "', `inputby`='" . $_SERVER['REMOTE_USER'] . "' WHERE `id` = '" . $_GET['id'] . "'";
			$result = $db->query($sql);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
		//iterates through each autority table, deleting existing information. Will add all information back in in steps below
		foreach ($tables as $table){
			try{
			$sql = "DELETE FROM `$table` WHERE `article` ='" . $_GET['id'] ."'";
			$result = $db->query($sql);
			} catch(PDOException $ex) {
				echo 'Connection failed: ' . $ex->getMessage();
			}
		}
		// if id is previously assigned (i.e. if article is "updated" not "new"), assigns id variable by drawing in paramater
		$id = $_GET['id'];
	
	
	//If article does not exist (i.e. is new), creates entry for new article. 		
	}else{	
	// Inserts new data NOT linked to authority table into new article entry. 
		try{
			$sql = "INSERT INTO `articles` (`title`,`date`,`source`,`url`,`text`,`inputby`) VALUES ('" . $_POST['title'] . "','" . $_POST['date'] . "','" . $_POST['source'] . "','" . $_POST['url'] . "','" . $_POST['text'] . "','" . $_SERVER['REMOTE_USER'] . "')";
			$result = $db->query($sql);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
	// creates article id
		$id = $db->lastInsertId();
		echo "id= " . $id . "<br/>";	
	}
	
	// The below inserts authority data into both updated articles and new articles	
	foreach ($tables as $table){
		if ($_POST[$table] == null){
			continue;
		} else {
		foreach ($_POST[$table] as $eachone){
			try{
				$sql = "INSERT INTO $table (`article`,`id`) VALUES ($id , $eachone)";
				$result = $db->query($sql);
			} catch(PDOException $ex){
				echo  'Connection failed: ' . $ex->getMessage();
				}
			}
		}
	}
	
	//closes database connection
	$db = null;
?>