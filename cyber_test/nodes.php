<?php

require_once 'login.php';

$like = $_GET['term'];


$queryAuthor = "SELECT name,id FROM author_list";
$resultAuthor = mysql_query($queryAuthor);

while ($row = mysql_fetch_array($resultAuthor, MYSQL_ASSOC)){
	$row['id'] = (int)$row['id'];
	$row['group'] = '0';
	$nodes[]= $row;

}


$queryExpert = "SELECT name,id FROM expert_list";
$resultExpert = mysql_query($queryExpert);

while ($row = mysql_fetch_array($resultExpert, MYSQL_ASSOC)){
	$row['id'] = (int)$row['id'];
	$row['group'] = '3';
	$nodes[]= $row;

}

echo "{    \"nodes\": ";
echo json_encode($nodes);
echo ",    \"links\":        [        ]}";

?>