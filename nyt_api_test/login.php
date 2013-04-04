<?php // SI 664 Nabil Kashyap midterm 2.25.13
$db_hostname = 'localhost';
$db_database = 'nyt_test';
$db_username = 'cyberwar';
$db_password = 'cyberwar';

$db = mysql_connect($db_hostname,$db_username, $db_password)
   or die("Here's why we can't connect to the database: " . mysql_error());

mysql_select_db($db_database)
    or die("Here's why we can't select the database: " . mysql_error());
?>