<?php

require_once 'login.php';


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

// $nodes = "{    \nodes\: " . $nodes .",    \links\:        [        ]}";
$node["nodes"] = $nodes;
$nodesJSON = json_encode($node);
$jsonobj = json_decode($nodesJSON);

print_r($jsonobj['nodes']);






?>