<?PHP


	include 'config.php';
//sets up database connection
	try{
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
	}

//Updates existing entries
	if (isset($_GET['id'])){
		try{
			$sql = "UPDATE `articles` SET `title` = '". $_POST['title'] . "',`date`='" . $_POST['date'] . "',`source`='" . $_POST['source'] . "',`url`='" . $_POST['url'] . "',`text`='" . $_POST['text'] . "', `inputby`='" . $_SERVER['REMOTE_USER'] . "' WHERE `id` = '" . $_GET['id'] . "'";
			$result = $db->query($sql);
			echo $sql . "<br/>";
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
// Clears all the old tables and reinsert
		
		try{
			$sql = "DELETE FROM `authors` WHERE `article` = " . $_GET['id'];
			$result = $db->query($sql);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
		try{
			$sql = "DELETE FROM `actors` WHERE `article` = " . $_GET['id'];
			$result = $db->query($sql);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
		try{
			$sql = "DELETE FROM `attacks` WHERE `article` = " . $_GET['id'];
			$result = $db->query($sql);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
		try{
			$sql = "DELETE FROM `experts` WHERE `article` = " . $_GET['id'];
			$result = $db->query($sql);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
		try{
			$sql = "DELETE FROM `tech` WHERE `article` = " . $_GET['id'];
			$result = $db->query($sql);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
		$id = $_GET['id'];

		
	}else{	
//Creates new entry for new article
		try{
			$sql = "INSERT INTO `articles` (`title`,`date`,`source`,`url`,`text`,`inputby`) VALUES ('" . $_POST['title'] . "','" . $_POST['date'] . "','" . $_POST['source'] . "','" . $_POST['url'] . "','" . $_POST['text'] . "','" . $_SERVER['REMOTE_USER'] . "')";
			$result = $db->query($sql);
			echo $sql . "<br/>";
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		$id = $db->lastInsertId();	

	$con = mysql_connect("50.63.105.14","cyberarchivedev","Archive@ccess5");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("cyberarchivedev");
	
	if (isset($_GET['id'])){
		$query = "UPDATE `articles` SET `title` = '". $_POST['title'] . "',`date`='" . $_POST['date'] . "',`source`='" . $_POST['source'] . "',`url`='" . $_POST['url'] . "',`text`='" . $_POST['text'] . "', `inputby`='" . $_SERVER['REMOTE_USER'] . "' WHERE `id` = '" . $_GET['id'] . "'";
		$result = mysql_query($query);
		echo $query . "<br/>";
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		
		#just clear all the old tables and reinsert
		
		$query = "DELETE FROM `authors` WHERE `article` = " . $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		
		$query = "DELETE FROM `actors` WHERE `article` = " . $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		
		$query = "DELETE FROM `attacks` WHERE `article` = " . $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		
		$query = "DELETE FROM `experts` WHERE `article` = " . $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		
		$query = "DELETE FROM `tech` WHERE `article` = " . $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		
		$id = $_GET['id'];
	}else{	
		$query = "INSERT INTO `articles` (`title`,`date`,`source`,`url`,`text`,`inputby`) VALUES ('" . $_POST['title'] . "','" . $_POST['date'] . "','" . $_POST['source'] . "','" . $_POST['url'] . "','" . $_POST['text'] . "','" . $_SERVER['REMOTE_USER'] . "')";
		$result = mysql_query($query);
		echo $query . "<br/>";
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		
		$id = mysql_insert_id();
	

	}

	
	#author
	foreach ($_POST['author'] as $eachauth){

		try{
			$sql = "INSERT INTO `authors` (`article`,`author`) VALUES ('" . $id . "','" . $eachauth . "')";
			$result = $db->query($sql);
			echo $sql . "<br/>";
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();

		$query = "INSERT INTO `authors` (`article`,`author`) VALUES ('" . $id . "','" . $eachauth . "')";
		$result = mysql_query($query);
		echo $query . "<br/>";
		if (!$result){
			die('Error: ' . mysql_error());			

		}
	}
	
	
	#attack
	foreach ($_POST['attack'] as $eachatt){

		try{
			$sql = "INSERT INTO `attacks` (`article`,`attack`) VALUES ('" . $id . "','" . $eachatt . "')";
			$result = $db->query($sql);
			echo $sql . "<br/>";
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();

		$query = "INSERT INTO `attacks` (`article`,`attack`) VALUES ('" . $id . "','" . $eachatt . "')";
		$result = mysql_query($query);
		echo $query . "<br/>";
		if (!$result){
			die('Error: ' . mysql_error());			

		}
	}
	
	#actor
	foreach ($_POST['actor'] as $eachact){

		try{
			$sql = "INSERT INTO `actors` (`article`,`actor`) VALUES ('" . $id . "','" . $eachact . "')";
			$result = $db->query($sql);
			echo $sql . "<br/>";
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
	}
	
	
	#expert
	foreach ($_POST['expert'] as $eachexpt){
		try{
			$sql = "INSERT INTO `experts` (`article`,`expert`) VALUES ('" . $id . "','" . $eachexpt . "')";
			$result = $db->query($sql);
			echo $sql . "<br/>";
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();

		$query = "INSERT INTO `actors` (`article`,`actor`) VALUES ('" . $id . "','" . $eachact . "')";
		$result = mysql_query($query);
		echo $query . "<br/>";
		if (!$result){
			die('Error: ' . mysql_error());			
		}
	}
	
	#expert
	foreach ($_POST['expert'] as $eachexpt){
		$query = "INSERT INTO `experts` (`article`,`expert`) VALUES ('" . $id . "','" . $eachexpt . "')";
		$result = mysql_query($query);
		echo $query . "<br/>";
		if (!$result){
			die('Error: ' . mysql_error());			

		}
	}
	
	
	#tech
	foreach ($_POST['tech'] as $eachtech){

		try{
			$sql = "INSERT INTO `tech` (`article`,`tech`) VALUES ('" . $id . "','" . $eachtech . "')";
			$result = $db->query($sql);
			echo $sql . "<br/>";
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
	}
	
//prints new article or view article links

		$query = "INSERT INTO `tech` (`article`,`tech`) VALUES ('" . $id . "','" . $eachtech . "')";
		$result = mysql_query($query);
		echo $query . "<br/>";
		if (!$result){
			die('Error: ' . mysql_error());			
		}
	}


	echo "<a href='new_article.php'>New Article</a><br/>
	<a href='view_articles.php'>View Articles</a><br/>";
	
?>