<?php

require_once 'login.php';

$like = $_GET['term'];


$query = "SELECT name,id FROM author_list WHERE name LIKE '%$like%'";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	$row['value'] = htmlentities($row['name']);
	$row['id'] = (int)$row['id'];
	$row_set[]= $row;

}

echo json_encode($row_set);

?>