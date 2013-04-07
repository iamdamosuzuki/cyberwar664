<?php

require_once 'login.php';


$queryAuthor = "SELECT name,id FROM author_list";
$resultAuthor = mysql_query($queryAuthor);

while ($row = mysql_fetch_array($resultAuthor, MYSQL_ASSOC)){
	$row['id'] = (int)$row['id'];
	$row['group'] = '0';
	$bars[]= $row;

}


// $nodes = "{    \nodes\: " . $nodes .",    \links\:        [        ]}";
$data["bars"] = $bars;

foreach ($bars as $items)
$id[] = $items['id'];



$dataJSON = json_encode($id);
$jsonobj = json_decode($dataJSON, TRUE);



echo $dataJSON;

//print_r($jsonobj['nodes'][2]['id']);






?>