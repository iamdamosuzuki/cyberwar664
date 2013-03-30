<?php // SI 664 Nabil Kashyap midterm 2.25.13

session_start();
require_once 'login.php';

// based on the second post request to confirm that includes the row id
if(isset($_POST['confirm'])){
    $id = mysql_real_escape_string($_POST['id']);
    $query = "DELETE FROM cybertest WHERE id='$id'";        

    mysql_query($query)
        or die("FAIL!" . mysql_error() . "<a href='index.php'>Take me back please . . .</a>");

    $_SESSION['status'] = 2;
    header( 'Location: index.php' );
    return;
}

// based on the initial get request
$id = mysql_real_escape_string($_GET['id']);
$query = "SELECT * FROM cybertest WHERE id='$id'";        

mysql_query($query)
    or die("FAIL!" . mysql_error() . "<a href='index.php'>Take me back please . . .</a>");

$result = mysql_query($query)
    or die("FAIL! " . mysql_error() . " <a href='index.php'>Take me back please . . .</a>");
$row = mysql_fetch_row($result);

include_once 'header.php';

echo <<<_OUT
<h3 style='color:red'>are you sure you want to delete $row[1]?</h3>\n
<form method="post">
<input type="hidden" name="id" value="$id">\n
<input type='submit' value='delete' name='confirm'>
<a href='index.php'>cancel</a></form>
_OUT;


?>