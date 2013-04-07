<?PHP
<<<<<<< HEAD
	include 'config.php';
=======
>>>>>>> added all the files
	$table = $_GET['table'];
	$id = $_GET['entryid'];


<<<<<<< HEAD
//sets up database connection

	try{
	$db = new PDO($dsn, $user, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}	catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
}
	
//Justin, I had the below code due to the conversion process, seems important to query the database, but when I comment it out, the website still works. Am I missing something? Maybe because I $db->query($sql) as $row it's not necessary? 
	//try{
	//	$sql = "SELECT * FROM `$table` WHERE `id` = $id";
	//	$result = $db->query($sql);
	//} catch(PDOException $ex) {
	//	echo 'Connection failed: ' . $ex->getMessage();
	//}

//Provides user with selected entry to edit
	try{
		$sql = "SELECT * FROM `$table` WHERE `id`=$id";
		echo "<form action='authority.php?table=$table&update=t&id=$id' method='post'>
			 Input entry for table: $table <br/>";
		}	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
	}
	
	try{
		foreach ($db->query($sql) as $row){
			echo "Name: <input type='text' style='width:300px;' name='name' value='" . $row['name'] . "'/><br/>
			 About: <br/><textarea style='width:500px;height:200px;' name='about'>" . $row['about'] . "</textarea><br/>";
			}
	} catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
	}
 	 
// offers submit and delete options

	echo "<input type='submit' value='Submit'></form>
	<form action='delete.php?table=$table&id=$id' method='post'><input type='submit' value='Delete'/></form>";
	
	$db = null;
=======
	$con = mysql_connect("50.63.105.14","cyberarchivedev","Archive@ccess5");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("cyberarchivedev");
	
	
	$query = "SELECT * FROM `$table` WHERE `id` = $id";
	$result = mysql_query($query);
	if (!$result){
		die('Error: ' . mysql_error());			
	}
	
	$match = mysql_fetch_array($result);
	
	echo "<form action='authority.php?table=$table&update=t&id=$id' method='post'>
		 Input entry for table: $table <br/>
		 If you are inputing a name make sure to put it last name first with a comma<br/>
		 Name: <input type='text' style='width:300px;' name='name' value='" . $match['name'] . "'/><br/>
		 About: <br/><textarea style='width:500px;height:200px;' name='about'>" . $match['about'] .
		 "</textarea><br/>
		 <input type='submit' value='Submit'>
		 </form><form action='delete.php?table=$table&id=$id' method='post'><input type='submit' value='Delete'/></form>";
	
	mysql_close($con);
>>>>>>> added all the files
?>