<?PHP
include 'header.php';
//provides configuration for database
$dsn = "mysql:dbname=cyberwar_test;host=localhost";
$user = "cyberwar";
$password = "cyberwar";

//creates array of users authorized to do large-scale tasks
$authSuperUsers=array('claire', 'justin');

//creates array of tables in the database
$tables = array('authors', 'actors', 'attacks', 'experts', 'techs');

$db_hostname = 'localhost';
$db_database = 'cyberwar_test';
$db_username = 'cyberwar';
$db_password = 'cyberwar';

$db = mysql_connect($db_hostname,$db_username, $db_password)
   or die("Here's why we can't connect to the database: " . mysql_error());

mysql_select_db($db_database)
    or die("Here's why we can't select the database: " . mysql_error());

?>