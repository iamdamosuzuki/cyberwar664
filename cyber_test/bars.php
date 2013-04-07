<?php

require_once 'login.php';


$queryAuthor = "SELECT COUNT(*) FROM author_list";
$queryExpert = "SELECT COUNT(*) FROM expert_list";
$queryArticle = "SELECT COUNT(*) FROM articles";
$queryActor = "SELECT COUNT(*) FROM actor_list";
$queryAttack = "SELECT COUNT(*) FROM attack_list";
$queryTech = "SELECT COUNT(*) FROM tech_list";

$resultAuthor = mysql_query($queryAuthor);
$resultExpert = mysql_query($queryExpert);
$resultArticle = mysql_query($queryArticle);
$resultActor = mysql_query($queryActor);
$resultAttack = mysql_query($queryAttack);
$resultTech = mysql_query($queryTech);

$count[] = (int)mysql_result($resultAuthor, 0);
$count[] = (int)mysql_result($resultExpert, 0);
$count[] = (int)mysql_result($resultArticle, 0);
$count[] = (int)mysql_result($resultActor, 0);
$count[] = (int)mysql_result($resultAttack, 0);
$count[] = (int)mysql_result($resultTech, 0);

// $nodes = "{    \nodes\: " . $nodes .",    \links\:        [        ]}";
//$data["bars"] = $bars;

//foreach ($bars as $items)
//$id[] = $items['id'];


$dataJSON = json_encode($count);
$jsonobj = json_decode($dataJSON, TRUE);

echo $dataJSON;


//print_r($jsonobj['nodes'][2]['id']);






?>