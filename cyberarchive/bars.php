<?php

$db_hostname = 'localhost';
$db_database = 'cyberwar_test';
$db_username = 'cyberwar';
$db_password = 'cyberwar';

$db = mysql_connect($db_hostname,$db_username, $db_password)
   or die("Here's why we can't connect to the database: " . mysql_error());

mysql_select_db($db_database)
    or die("Here's why we can't select the database: " . mysql_error());

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

$name[] = 'Authors';
$name[] = 'Experts';
$name[] = 'Articles';
$name[] = 'Actors';
$name[] = 'Attacks';
$name[] = 'Tech';

$color[] = "rgb(0,114,187)";
$color[] = "rgb(217,61,4)";
$color[] = "rgb(0,83,100)";
$color[] = "rgb(191,107,4)";
$color[] = "rgb(0,36,59)";
$color[] = "rgb(160,173,50)";


// $nodes = "{    \nodes\: " . $nodes .",    \links\:        [        ]}";
//$data["bars"] = $bars;

//foreach ($bars as $items)
//$id[] = $items['id'];

$data["count"] = $count;
$data["name"] = $name;
$data["color"] = $color;

$dataJSON = json_encode($data);
$jsonobj = json_decode($dataJSON, TRUE);

echo $dataJSON;


//print_r($jsonobj['nodes'][2]['id']);






?>