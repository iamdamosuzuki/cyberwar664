<?PHP
<<<<<<< HEAD
	include'config.php';
	$table = $_GET['table'];	
	$id = $_GET['id'];	
	$name = $_POST['name'];
	$about = $_POST['about'];
	
=======
	//include(config.php);
	$table = $_GET['table'];
	$id= $_GET['id'];

	


>>>>>>> added all the files
	echo "<a href='index.php'>Return to main page</a>
		 <form action='authority.php?table=$table&update=f' method='post'>
		 Input entry for table: $table <br/>
		 If you are inputing a name make sure to put it last name first with a comma<br/>
		 Name: <input type='text' style='width:300px;' name='name'/><br/>
		 About: <br/><textarea style='width:500px;height:200px;' name='about'></textarea><br/>
		 <input type='submit' value='Submit'>
		 </form>";

<<<<<<< HEAD


//setup the database connection
=======
//Below listed variable should not be necessary due to inclusion of config.php; whole process needs to be debugged. 
$dsn = 'mysql:dbnam=cyberarchivedev;host=50.63.105.14';
$user = 'cyberarchivedev';
$password = 'Archive@ccess5';

//setup the database connection
// Opens database and queries it to set attributes. If database does not respond (equiv of if !=$db), then throws connection failed message and reason for failure (as per PDOEXCEPTION)

>>>>>>> added all the files
	try{
		$db = new PDO($dsn, $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}	catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
<<<<<<< HEAD
	}

//creates new entry for entered data or updates entered data

	if(isset($_POST['name']) & $_POST['name'] != ""){
		if($_GET['update'] != 't'){
			try{
			$query = $db->prepare("INSERT INTO $table (`name`, `about`) VALUES (:name, :about)");
			$query->execute(array(':name' => $name, ':about' => $about));
			} catch(PDOException $ex) {
					echo 'Connection failed: ' . $ex->getMessage(); 
			}
		}else{
			try{$query = "UPDATE `$table` SET `name`='" . $_POST['name'] . "', `about`='" . $_POST['about'] . "'WHERE `id`='$id'";
			echo $query . "</br>";
			$result = $db->query($query);
=======
		exit;
	}


	
	if(isset($_POST['name']) & $_POST['name'] != ""){
		if($_GET['update'] != 't'){
			// GOOD TO HERE
			$query = $db->prepare('INSERT INTO $table (name, about) VALUES (:name, :about)');
			$query->bindParam(':name', $name, PDO::PARAM_STR);
			$query->bindParam(':about', $about, PDO::PARAM_STR);
			try{
				$query->execute();
				echo $query . "</br>";
				$result = $db->query($query);
				} catch(PDOException $ex) {
					echo '2Connection failed: ' . $ex->getMessage();
					exit; 
			}
		}else{
			$query = "UPDATE `$table` SET `name`='" . $_POST['name'] . "', `about`='" . $_POST['about'] . "'WHERE `id`='$id'" . $db->quote($zip);
			echo $query . "</br>";
			try{
				$result = $db->query($query);
>>>>>>> added all the files
			} catch(PDOException $ex) {
				echo 'Connection failed: ' . $ex->getMessage();
			}
			echo "submitted<br/>";
<<<<<<< HEAD
		}
	}

//prints table of corresponding authority values
	echo "<table border=1><col width='200'>";
	
	try{
	$sql = "SELECT * FROM `$table` ORDER BY `name`";
	foreach ($db->query($sql) as $row){
		echo "<tr><td><a href='edit_entry.php?table=$table&entryid=" . $row['id'] . "'>" . $row['name'] . "</a></td><td>" . $row['about'] . "</td></tr>";
	}
	} catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
	}
	
	echo "</table>";
=======
	}


	$query = "SELECT * FROM `$table` ORDER BY `name`" . $db->quote($zip);
	try{
	$result = $db->query($query);
	} catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();			
	}
 
        echo "<table border=1><col width='200'>";

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$result_show . "<tr><td><a href='edit_entry.php?table=$table&entryid=" . $row['id'] . "'>" 
		. $row['name'] . "</a></td><td>" . $row['about'] . "</td></tr>";
	}
		return $result_show;}
	
        echo "</table>";
>>>>>>> added all the files
	
	$db = null;
?>