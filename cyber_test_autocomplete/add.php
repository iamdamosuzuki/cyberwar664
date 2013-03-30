<?php // SI 664 Nabil Kashyap midterm 2.25.13
session_start();
require_once 'login.php';
    
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
        
        $query = "INSERT INTO geodata(location,lat,lng) VALUES
            ('$location','$lat','$lng')";
        
        mysql_query($query)
            or die("insert failed " . mysql_error());
        
        $_SESSION['status'] = 1;
        header('Location: index.php');
        return;
}}
 
include_once 'header.php';

echo <<<_OUT
<h2>add a new location</h2>
<form method='post'>
location : <input type='text' name='location'><br /><br /> 
latitude : <input type='text' name='lat'><br /><br />
longitude : <input type='text' name='lng'><br /><br />
<input id='button' type='submit' value='add location'><a href='index.php'>cancel</a>
</form>
_OUT;
?>