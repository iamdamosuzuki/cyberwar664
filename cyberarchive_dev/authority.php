<?PHP
// This document allows user to enter new data into selected authority tables, as well as to view all entries already existent in selected authority table.
	
	// includes util.php, which sets up database connection and includes config.php.
	include 'util.php';
	
	echo "<body>";
	
	//creates variables for document and fetches correct table and entry id information
	$table = $_GET['table'];	
	$id = $_GET['id'];	
	$name = $_POST['name'];
	$about = $_POST['about'];

	//prints "return to main page" link and creates form to be filled with new or updated entry information. 	
	echo "<a href='index.php'>Return to main page</a>";
	echo "<form action='authority.php?table=$table&update=f' method='post'>Input entry for table: $table <br/>
		If you are entering a name, enter it in the format: Last Name COMMA First Name<br/>
		Name: <input type='text' style='width:300px;' name='name' required=required/><br/>
		About: <br/><textarea style='width:500px;height:200px;' name='about' required=required></textarea><br/>
		<input type='submit' value='Submit'/></form>";

	//For new entry, creates new entry in authority table, inserting "name" and "about" information into table. 
	if(isset($_POST['name']) & $_POST['name'] != ""){
			try{
		// because double and single quotation marks / apostrophes are printed with the "escape" backslash when run through php to html, this section uses reg ex's to delete the escape character, both in "name" and in "about" 
			$name = quoteFixDoub($name);
			$name = quotefixSing($name);
			
			$about = quotefixSing($about);
			$about = quoteFixDoub($about);
					
			} catch(PDOException $ex) {
					echo 'Connection failed: ' . $ex->getMessage(); 
			}
		if($_GET['update'] != 't'){
			try{
			$query = $db->prepare("INSERT INTO $table (`name`, `about`) VALUES (:name, :about)");
			$query->execute(array(':name' => $name, ':about' => $about));
			echo $name . $about . "<br/>";
                        echo "Submitted<br/>";
			
			} catch(PDOException $ex) {
					echo 'Connection failed: ' . $ex->getMessage(); 
			}
		}else{
	
	//for updated entry, replaces existing data with new data in relevant table. 
			try{$query = "UPDATE `$table` SET `name`='" . $_POST['name'] . "', `about`='" . $_POST['about'] . "'WHERE `id`='$id'";
			echo $query . "</br>";
			$result = $db->query($query);
			// Prints "updated" statement
			echo "Submitted<br/>";
			} catch(PDOException $ex) {
				echo 'Connection failed: ' . $ex->getMessage();
			}
		}
	}
	
	//prints table of all entries in authority table that is being updated 
	echo "<table border=1><col width='200'>";
	try{
	$sql = "SELECT * FROM `$table` ORDER BY `name`";
	foreach ($db->query($sql) as $row){
		echo "<tr><td><a href='edit_entry.php?table=$table&entryid=" . $row['id'] . "'>" . $row['name'] . "</a></td><td>" . $row['about'] . 			"</td></tr>";
	}
	} catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
	}
	
	echo "</table>";
	echo "</body>";
	
	//closes database connection
	$db = null;
?>