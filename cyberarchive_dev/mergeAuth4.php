<?PHP
// This document provides authorized users with option to delete selected authority table entries.

//include util.php document, which sets up database connection and includes config.php
include 'util.php';

//pulls in "get" and "post" variables from mergeAuth3.php
$id = $_GET['id'];
$table_data = $_GET['table_data'];
$table = $_GET['table'];
$name = $_POST['name'];
$about = $_POST['about'];

//creates variable $table2, which accesses [authority]_list tables of database
$table2 = $table."_list";

//if the name of the edited entry is not null, runs the below loop. 
if(isset($_POST['name']) & $_POST['name'] != ""){
	//Updates the selected title's entry in $table_list. Echoes the update and prints "success" message. 
	try{$query = "UPDATE `$table2` SET `name`='" . $_POST['name'] . "', `about`='" . $_POST['about'] . "'WHERE `id`='$id'";
			echo "The following update has been submitted:<br> ";
			echo $query . "</br>";
			$result = $db->query($query);
			// Prints "updated" statement
			echo "<br><b>Update successful</b><br/><br/>";
			} catch(PDOException $ex) {
				echo 'Connection failed: ' . $ex->getMessage();
			}
// This is the function that deletes the entries that are being merged into the above updated title.

//Explodes the passed variable $table_array to access each of its elements. 
$data_array = explode(",", $table_data);

//searches for and removes the id of the selected merge title from the array, so that only items being merged into this selected title will be deleted. 
$key = array_search($id, $data_array); 
unset($data_array[$key]);
//renumbers the data array to fill hole left by removal of $key. 
$data_array= array_values($data_array);

//Deletes each id in the $data_array from both $table and $table2 ($table_list)
echo "The following titles have been deleted:<br>";
foreach($data_array as $value){
	try{
	$sql = "DELETE FROM `$table` WHERE $value = `id`";
	$result = $db->query($sql);
	} catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
	}

// deletes selected entry from the above-called authority table ($table2). 
	try{
	$sql = "DELETE FROM `$table2` WHERE $value = `id`";
	$result = $db->query($sql);
	} catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
	}
        echo $table." value ".$value." deleted.<br><br>";
}

//prints "merge successful" statement and links back to merge index and main page. 
        echo "<b>Merge successful</b>";
	echo "</br>Return to <a href='index.php'>main page</a><br>Return to <a href='mergeAuth.php'>merge index.</a>";

} else {
	// if edited entry has a name that is NULL, prints this statement with link back to mergeAuth menu. 
	echo "Sorry, you must give the merged authority title a 'name.'<br>Return to <a href='mergeAuth.php'>merge menu.</a>";
}
//closes database connection. 
	$db = null;
        
?>