<?php // SI 664 Nabil Kashyap midterm 2.25.13
session_start();
require_once 'login.php';

// based on the second post request
if (isset($_POST['location']) && isset($_POST['lat']) && isset($_POST['lng'])){
    
    
    if((!$_POST['location']) || (!$_POST['lat']) || (!$_POST['lng'])){
    
        $_SESSION['status'] = 4;
        header('Location: index.php');
        return;
        
    }else if(!is_numeric($_POST['lat']) || !is_numeric($_POST['lng'])){
    
        $_SESSION['status'] = 7;
        header('Location: index.php');
        return;

    }else if ($_POST['lat'] < -90 || $_POST['lat'] > 90) {

        $_SESSION['status'] = 5;
        header('Location: index.php');
        return;
                
    }else if ($_POST['lng'] < -180 || $_POST['lng'] > 180) {
    
        $_SESSION['status'] = 6;
        header('Location: index.php');
        return;
        
    }else{

        $location = mysql_real_escape_string($_POST['location']);
        $lat = mysql_real_escape_string($_POST['lat']);
        $lng = mysql_real_escape_string($_POST['lng']);
        $id = mysql_real_escape_string($_POST['edit']);
        
        $query = "UPDATE geodata SET location='$location', lat='$lat', lng='$lng' WHERE id ='$id'";
        
        mysql_query($query)
            or die("update failed " . mysql_error());
    
        $_SESSION['status'] = 3;
        header('Location: index.php');
        return;
}}

// based on the initial get request
$id = mysql_real_escape_string($_GET['id']);
$query = "SELECT * FROM geodata WHERE id='$id'";        

mysql_query($query)
    or die("FAIL!" . mysql_error() . "<a href='index.php'>Take me back please . . .</a>");

$result = mysql_query($query)
    or die("FAIL! " . mysql_error() . " <a href='index.php'>Take me back please . . .</a>");
$row = mysql_fetch_row($result);

$location = htmlentities($row[1]);
$lat = htmlentities($row[2]);
$lng = htmlentities($row[3]);

include_once 'header.php';

echo <<<_OUT
<h2>edit track</h2>
<form method='post' action='edit.php'>
Location : <input type='text' value="$location" name='location'><br /> 
Latitude : <input type='text' value="$lat" name='lat'><br />
Longitude : <input type='text' value="$lng" name='lng'><br />
<input type='hidden' value="$id" name='edit'><br />
<input type='submit' value='update'><a href='index.php'>cancel</a>
</form>
_OUT;
?>



