<?PHP
//includes util.php, which sets up database connection. 
include 'util.php';

//pulls posted variables in from mergeAuth.php
$table = $_POST['table2'];
$table_data = $_POST['table'];

//creates variable $table2, which will be used to access [authority]_list tables of database. 
$table2 = $table . "_list";

//explodes passed array $table_data, which will be iterated through below. 
$data_array = explode(",", $table_data);

//prints links to return to other spaces of database
echo "Return to <a href='index.php'>main page.</a><br>Return to <a href='mergeAuth.php'>merge menu</a><br>Return to <a href='admin.php'>admin page.</a><br><br>";

//prints introductory text
echo "Viewing merge selection for <b>" . $table ."</b>.<br>Please choose which title you would like to merge all of the selected titles into.<br><br>";

//prints radio button form containing passed elements in $table_data array; user selects which title she would like to merge the other titles into. only one button can be selected. Currently, only "name" is printed; "about" could be easily printed by inserting next to $row['name'].

echo "<form name='input' action='mergeAuth3.php?table_data=$table_data&table=$table' method='post'>";
foreach($data_array as $value){
    $sql = "SELECT * FROM $table2 WHERE $value = `id`";
    foreach ($db->query($sql) as $row){
        $id=$row['id'];
        echo "<input type='radio' name='name' value='".$id."'>".$row['name']."<br>"; 
    }
}
//prints "submit" button, linked with "confirm" prompt. 
echo "<input type='submit' value='Merge' onclick='return testConfirm();'/></form>";

//closes database connection. 
$db=null;

?>

