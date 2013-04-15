ƒ<?PHP

	include'config.php';

	
	// set up database connection
	
	try{
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}	catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
	}

	
	
	//If there is a previous post for editing pull the data
	if(isset($_GET['id'])){
		try{
			$sql ="SELECT * FROM `articles` WHERE `id`=". $_GET['id'];
			$result = $db->prepare($sql);
			$result->execute();
			$curart = $result->fetch(PDO::FETCH_ASSOC);
			} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}

		
		try{
			$sql ="SELECT `author` FROM `authors` WHERE `article`=". $_GET['id'];
			foreach ($db->query($sql) as $row){
				$curauths[$row['author']] = 1;
			}
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}
		
		
		try{
			$sql ="SELECT `attack` FROM `attacks` WHERE `article`=". $_GET['id'];
			foreach ($db->query($sql) as $row){
				$curattacks[$row['attack']] = 1;
			}
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}

		try{
			$sql ="SELECT `actor` FROM `actors` WHERE `article`=". $_GET['id'];
			foreach ($db->query($sql) as $row){
				$curacts[$row['actor']] = 1;
			}
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}
		
		try{
			$sql ="SELECT `expert` FROM `experts` WHERE `article`=". $_GET['id'];
			foreach ($db->query($sql) as $row){
				$curexpts[$row['expert']] = 1;
			}
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}
		
		try{
			$sql="SELECT `tech` FROM `tech` WHERE `article`=". $_GET['id'];
			foreach ($db->query($sql) as $row){
				$curtech[$row['tech']] = 1;
			}
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}
	}
//Provides "return to main page" option	
	echo "<a href='index.php'>Return to main page</a>
		 <form action='submit_article.php'"; 

//Provides options for creation of new aritcle. 	


	$con = mysql_connect("localhost","cyberwar","cyberwar");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("cyberwar_test");
	
	#if there is a previous post for editing pull the data
	if(isset($_GET['id'])){
		$query ="SELECT * FROM `articles` WHERE `id`=". $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		$curart = mysql_fetch_array($result);
		
		$query ="SELECT `author` FROM `authors` WHERE `article`=". $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		while ($row = mysql_fetch_array($result)){
			$curauths[$row['author']] = 1;
		}
		
		$query ="SELECT `attack` FROM `attacks` WHERE `article`=". $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		while ($row = mysql_fetch_array($result)){
			$curattacks[$row['attack']] = 1;
		}

		$query ="SELECT `actor` FROM `actors` WHERE `article`=". $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		while ($row = mysql_fetch_array($result)){
			$curacts[$row['actor']] = 1;
		}
	
		$query ="SELECT `expert` FROM `experts` WHERE `article`=". $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		while ($row = mysql_fetch_array($result)){
			$curexpts[$row['expert']] = 1;
		}
		
		$query ="SELECT `tech` FROM `tech` WHERE `article`=". $_GET['id'];
		$result = mysql_query($query);
		if (!$result){
			die('Error: ' . mysql_error());			
		}
		while ($row = mysql_fetch_array($result)){
			$curtech[$row['tech']] = 1;
		}
	}
	
	// echo "<a href='index.php'>Return to main page</a>
echo		 "<form action='submit_article.php"; 
	

	if(isset($_GET['id'])){
		echo "?id=" . $_GET['id'];
	}
	
	echo "' method='post'>Author: 
	<input id='authorBox' type='text' name='author'><br /><br />  
	<select name='author[]' id='authorSelect' size='10' multiple='multiple'>";

	try{
		$sql = "SELECT * FROM `author_list` ORDER BY `name`";
		foreach ($db->query($sql) as $row) {
			echo "<option value='". $row['id']. "'";
			if (isset($curauths[$row['id']])){
				echo " selected='selected'";
			}
			echo ">" . $row['name'] . "</option>";
			}
	} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
	
	echo "</select><br/>Attack:
	<input id='attackBox' type='text' name='attack'><br /><br />  
	<select name='attack[]' id='attackSelect' size='10' multiple='multiple'>";

	try{
		$sql = "SELECT * FROM `attack_list` ORDER BY `name`";
		foreach ($db->query($sql) as $row){
			echo "<option value='". $row['id']. "'";
			if (isset($curattacks[$row['id']])){
				echo " selected='selected'";
			}
			echo ">" . $row['name'] . "</option>";
		}
	} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
	
	echo "</select><br/>Actor: 
	<input id='actorBox' type='text' name='actor'><br /><br />  
	<select name='actor[]' id='actorSelect' size='10' multiple='multiple'>";

	try{
		$sql = "SELECT * FROM `actor_list` ORDER BY `name`";
		foreach ($db->query($sql) as $row){
			echo "<option value='". $row['id']. "'";
			if (isset($curacts[$row['id']])){
				echo " selected='selected'";
			}
			echo ">" . $row['name'] . "</option>";
		}
	} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
	echo "</select><br/>Expert: 
	<input id='expertBox' type='text' name='expert'><br /><br />  
	<select name='expert[]' id='expertSelect' size='10' multiple='multiple'>";

	try{
		$sql = "SELECT * FROM `expert_list` ORDER BY `name`";
		foreach ($db->query($sql) as $row){
			echo "<option value='". $row['id']. "'";
			if (isset($curexpts[$row['id']])){
				echo " selected='selected'";
			}
		echo ">" . $row['name'] . "</option>";
		}
	} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		
	echo "</select><br/>Tech:
	<input id='techBox' type='text' name='tech'><br /><br />  
	<select name='tech[]' id='techSelect' size='10' multiple='multiple'>";

	try{
		$sql = "SELECT * FROM `tech_list` ORDER BY `name`";
		foreach ($db->query($sql) as $row){
			echo "<option value='". $row['id']. "'";
			if (isset($curtech[$row['id']])){
				echo " selected='selected'";
			}
			echo ">" . $row['name'] . "</option>";
		}
	} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}

	//Note that ote New york times is the only current option for source
	//Provides option for article source, title, url, data, and "about"; submits form. 

// $query = "SELECT * FROM `author_list` ORDER BY `name`";
// $result = mysql_query($query);
// if (!$result){
// 	die('Error: ' . mysql_error());			
// }

// while($row = mysql_fetch_array($result)){
// 	echo "<option value='". $row['id']. "'";
// 	if (isset($curauths[$row['id']])){
// 		echo " selected='selected'";
// 	}
// 	echo ">" . $row['name'] . "</option>";
// }


// echo "</select><br/>Attack:
// <input id='textbox' type='text' name='attack'><br /><br />  
// <select name='attack[]' id='select' size='10' multiple='multiple'>";

// $query = "SELECT * FROM `attack_list` ORDER BY `name`";
// $result = mysql_query($query);
// if (!$result){
// 	die('Error: ' . mysql_error());			
// }

// while($row = mysql_fetch_array($result)){
// 	echo "<option value='". $row['id']. "'";
// 	if (isset($curattacks[$row['id']])){
// 		echo " selected='selected'";
// 	}
// 	echo ">" . $row['name'] . "</option>";
// }

// echo "</select><br/>Actor: 
// <input id='textbox' type='text' name='actor'><br /><br />  
// <select name='actor[]' id='select' size='10' multiple='multiple'>";

// $query = "SELECT * FROM `actor_list` ORDER BY `name`";
// $result = mysql_query($query);
// if (!$result){
// 	die('Error: ' . mysql_error());			
// }

// while($row = mysql_fetch_array($result)){
// 	echo "<option value='". $row['id']. "'";
// 	if (isset($curacts[$row['id']])){
// 		echo " selected='selected'";
// 	}
// 	echo ">" . $row['name'] . "</option>";
// }

// echo "</select><br/>Expert: 
// <input id='textbox' type='text' name='expert'><br /><br />  
// <select name='expert[]' id='select' size='10' multiple='multiple'>";

// $query = "SELECT * FROM `expert_list` ORDER BY `name`";
// $result = mysql_query($query);
// if (!$result){
// 	die('Error: ' . mysql_error());			
// }

// while($row = mysql_fetch_array($result)){
// 	echo "<option value='". $row['id']. "'";
// 	if (isset($curexpts[$row['id']])){
// 		echo " selected='selected'";
// 	}
// 	echo ">" . $row['name'] . "</option>";
// }
// echo "</select><br/>Tech:
// <input id='textbox' type='text' name='tech'><br /><br />  
// <select name='tech[]' id='select' size='10' multiple='multiple'>";

// $query = "SELECT * FROM `tech_list` ORDER BY `name`";
// $result = mysql_query($query);
// if (!$result){
// 	die('Error: ' . mysql_error());			
// }

// while($row = mysql_fetch_array($result)){

// 	echo "<option value='". $row['id']. "'";
// 	if (isset($curtech[$row['id']])){
// 		echo " selected='selected'";
// 	}
// 	echo ">" . $row['name'] . "</option>";
// }

	
	#note New york times is the only current option for source
	

	echo"</select><br/>Source: <select name='source'><option value='nyt'>New York Times</option></select><br/>Title:<input type='text' name='title' 
	value='" . $curart['title'] . "'/>
	<br/>Date(YYYY-MM-DD):<input type='text' name='date' value='" . $curart['date'] . "'/><br/>
	URL:<input type='text' name='url' size='100' value='" . $curart['url'] . 
	"'/><br/>Text: <br/><textarea style='width:500px;height:200px;' name='text'>" . $curart['text'] . 
	"</textarea><br/><input type='submit' value='Submit'>
	</form>";

	
	$db = null;



	
	
	mysql_close($con);

?>