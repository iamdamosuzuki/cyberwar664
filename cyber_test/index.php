<?php // SI 664 Nabil Kashyap Cyber Test
session_start();
require_once 'login.php';

$_SESSION['status'] = (isset($_SESSION['status'])) ? $_SESSION['status'] : '';

session_destroy(); 

if (isset($_POST['first']) && isset($_POST['last'])){
    
    
    if((!$_POST['first']) || (!$_POST['last'])){
    
        $_SESSION['status'] = 4;
        header('Location: index.php');
        return;
        
    }else if(is_numeric($_POST['first']) || is_numeric($_POST['last'])){
    
        $_SESSION['status'] = 7;
        header('Location: index.php');
        return;
        
    }else{

        $first = mysql_real_escape_string($_POST['first']);
        $last = mysql_real_escape_string($_POST['last']);
        
        $query = "INSERT INTO author_list(name) VALUES
            ('$name')";
        
        mysql_query($query)
            or die("insert failed " . mysql_error());
        
        $_SESSION['status'] = 1;
        header('Location: index.php');
        return;
}}

include_once 'header.php';

 
echo "<h1>CYBER TEST DATABASE</h1>";

// shows the right message based on the $_SESSION variable then gets rid of the variable
switch($_SESSION['status']){

case 1: echo "<h2 style = 'color:green'>name added</h2>"; break;
case 2: echo "<h2 style = 'color:red'>name deleted</h2>"; break;
case 3: echo "<h2 style = 'color:green'>name updated</h2>"; break;
case 4: echo "<h2 style = 'color:red'>all values required</h2>"; break;
case 5: echo "<h2 style = 'color:red'>latitude must be between -90 and 90 degrees</h2>"; break;
case 6: echo "<h2 style = 'color:red'>longitude must be between -180 and 180 degrees</h2>"; break;
case 7: echo "<h2 style = 'color:red'>latitude & longitude must be numeric</h2>"; break;

}

// builds the table based on the database data
echo "<table><tr><th>id</th><th>name</th></tr>";

$query = "SELECT * FROM author_list";
$result = mysql_query($query);
$rows = mysql_num_rows($result);

for ($i = 0; $i < $rows ; ++$i){
    $row = mysql_fetch_row($result);
    echo "<tr>";
    for ($j = 0; $j < count($row)-1; ++$j) echo "<td>$row[$j]</td>";
    echo '<td><a href="edit.php?id=' . htmlentities($row[2]) .'">edit</a> /';
    echo ' <a href="delete.php?id=' . htmlentities($row[2]) . '">delete</a></td>';
}

echo "</table>";
echo "<a href='add.php'>add new</a>";


echo <<<_OUT
<h2>add a new name</h2>
<form method='post'>
first : <input type='text' name='first'><br /><br /> 
last : <input type='text' name='last'><br /><br />
<input id='button' type='submit' value='add'><a href='index.php'>cancel</a>
</form>
_OUT;
?>