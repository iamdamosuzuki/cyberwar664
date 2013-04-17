<?PHP
//includes util.php, which sets up database
include 'util.php';

//pulls passed variables in from mergeAuth2.hp
$id = $_POST['name'];
$table_data = $_GET['table_data'];
$table = $_GET['table'];
//creates variable to access database tables that are titled [authority]_list
$table2 = $table."_list";

//explodes $table_data array; removes $id from array, only leaving titles that will be deleted. 
$data_array = explode(",", $table_data);
$key = array_search($id, $data_array); 
unset($data_array[$key]);
$data_array= array_values($data_array);

//provides links back to other sections
echo "Return to <a href='index.php'>main page.</a><br/>";
echo "Return to <a href='mergeAuth.php'>merge menu.</a><br/><br/>";

//prints $id entry (selected title to merge into) with editing options, as in edit_entry.php
echo "Showing selected title for merge on <b>".$table."</b><br><br>";
	try{
		$sql = "SELECT * FROM `$table2` WHERE `id`=$id";
		echo "<form action='mergeAuth4.php?table_data=$table_data&table=$table&id=$id' method='post' onsubmit='return testConfirm();'>";
		}	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
	}

		foreach ($db->query($sql) as $row){
			// because single quotation mark gets lost in html, this reg ex will replace single quotation, where present, with encoded character. 
			try{
			//calls the function quotefixSing (in util.php), which fixes the single quotation bug, if present. 
				$row['name'] = quotefixSing($row['name']);
			//prints "name" and "about" form and inserts entry information into form. 			
				echo "Name: <input type='text' style='width:300px;' name='name' value='" . $row['name'] . "' required=required/><br/>
				About: <br/><textarea style='width:500px;height:200px;' name='about' required=required>" . $row['about'] . "</textarea><br/>";
			} catch(PDOException $ex){
				echo 'Connection failed: ' . $ex->getMessage();
			}
                }
//prints "name" and "about" of entries that will be merged into the above title. (this information will be deleted in mergeAuth4.php)
echo "<br><b>Below are the entries that will be merged into the above entry:</b><br><br>";
foreach($data_array as $value){
    $sql = "SELECT * FROM $table2 WHERE $value = `id`";
    foreach ($db->query($sql) as $row){
        echo "<b>".$row['name']."</b><br>".$row['about']."<br><br>"; 
    }
}

//prints merge button. 
echo "<input type='submit' value='Merge'/></form>";
        
//closes database connection. 
$db=null;            
?>