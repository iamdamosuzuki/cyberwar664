<?php

//this phpf fle creates a json file that has the information for the bar chart

include 'util.php';


$db_hostname = 'localhost';
$db_database = 'cyberwar_test';
$db_username = 'cyberwar';
$db_password = 'cyberwar';

// set up database connection

try{
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }	catch(PDOException $ex) {
    echo 'Connection failed: ' . $ex->getMessage();
}

//There's are the queries for the count of each table

$queryAuthor = "SELECT COUNT(*) FROM author_list";
$queryExpert = "SELECT COUNT(*) FROM expert_list";
$queryArticle = "SELECT COUNT(*) FROM articles";
$queryActor = "SELECT COUNT(*) FROM actor_list";
$queryAttack = "SELECT COUNT(*) FROM attack_list";
$queryTech = "SELECT COUNT(*) FROM tech_list";

//this gets the results in teh form of an associated array

$result = $db->prepare($queryAuthor);
$result->execute();
$resultAuthor = $result->fetch(PDO::FETCH_ASSOC);

$result = $db->prepare($queryExpert);
$result->execute();
$resultExpert = $result->fetch(PDO::FETCH_ASSOC);

$result = $db->prepare($queryArticle);
$result->execute();
$resultArticle = $result->fetch(PDO::FETCH_ASSOC);

$result = $db->prepare($queryActor);
$result->execute();
$resultActor = $result->fetch(PDO::FETCH_ASSOC);

$result = $db->prepare($queryAttack);
$result->execute();
$resultAttack = $result->fetch(PDO::FETCH_ASSOC);

$result = $db->prepare($queryTech);
$result->execute();
$resultTech = $result->fetch(PDO::FETCH_ASSOC);


//this takes the count and puts it in a json object, formatting
//it the way D3 wants it

$count[] = (int)$resultAuthor['COUNT(*)'];
$count[] = (int)$resultExpert['COUNT(*)'];
$count[] = (int)$resultArticle['COUNT(*)'];
$count[] = (int)$resultActor['COUNT(*)'];
$count[] = (int)$resultAttack['COUNT(*)'];
$count[] = (int)$resultTech['COUNT(*)'];

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

$data["count"] = $count;
$data["name"] = $name;
$data["color"] = $color;

$dataJSON = json_encode($data);
$jsonobj = json_decode($dataJSON, TRUE);

echo $dataJSON;


?>