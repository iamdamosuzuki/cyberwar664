<?php // generates links data for the network.php force-directed graph

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

//use the get request to set the dropdown menu selections
//the default state is Authors and Experts
    
if ($_GET['sourceTable'] == ''){
    $sourceTable = 'authors';
}
else{
    $sourceTable = $_GET['sourceTable'] ;
}

if ($_GET['targetTable'] == ''){
    $targetTable = 'experts';
}
else{
    $targetTable = $_GET['targetTable'] ;
}

//Creates variables that form the MySQL queries depending on what is selected in the dropdown menu

switch($sourceTable)
{
    case 'actors';
        $sourceList = 'actor_list';
        break;
    case 'attacks';
        $sourceList = 'attack_list';
        break;
    case 'authors';
        $sourceList = 'author_list';
        break;
    case 'experts';
        $sourceList = 'expert_list';
        break;
    case 'tech';
        $sourceList = 'tech_list';
        break;
    break;
}

switch($targetTable)
{
    case 'actors';
        $targetList = 'actor_list';
        break;
    case 'attacks';
        $targetList = 'attack_list';
        break;
    case 'authors';
        $targetList = 'author_list';
        break;
    case 'experts';
        $targetList = 'expert_list';
        break;
    case 'tech';
        $targetList = 'tech_list';
        break;
    break;
}


//Creates variables that form the MySQL queries depending on what is selected in the dropdown menu


switch($sourceTable)
{
    case 'actors';
        $sourceRow = 'actor';
        break;
    case 'attacks';
        $sourceRow = 'attack';
        break;
    case 'authors';
        $sourceRow = 'author';
        break;
    case 'experts';
        $sourceRow = 'expert';
        break;
    case 'tech';
        $sourceRow = 'tech';
        break;
    break;
}

switch($targetTable)
{
    case 'actors';
        $targetRow = 'actor';
        break;
    case 'attacks';
        $targetRow = 'attack';
        break;
    case 'authors';
        $targetRow = 'author';
        break;
    case 'experts';
        $targetRow = 'expert';
        break;
    case 'tech';
        $targetRow = 'tech';
        break;
    break;
}


//The following two queries create the $nodes[] array, which D3 uses to create the nodes
// $querySource ="SELECT name," . $sourceList . ".id,articles.date FROM " . $sourceList . " JOIN " . $sourceTable . " JOIN articles ON " . $sourceList . ".id = " . $sourceTable . "." . $sourceRow . " AND " . $sourceTable . ".article = articles.id";



try{
    $querySource = "SELECT name,id FROM " . $sourceList;
	$result = $db->prepare($querySource);
	$result->execute();
//	$resultSource = $result->fetch(PDO::FETCH_ASSOC);
    foreach ($db->query($querySource) as $row){
        $row['id'] = (int)$row['id'];
        $row['group'] = 0;
        $nodes[]= $row;;
        }
	} catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
	}



try{
	$queryTarget ="SELECT name,id FROM " . $targetList;
	$result = $db->prepare($queryTarget);
	$result->execute();
    $resultSource = $result->fetch(PDO::FETCH_ASSOC);
    foreach ($db->query($queryTarget) as $row){
        $row['id'] = (int)$row['id'];
        $row['group'] = 2;
        $nodes[]= $row;;
        }
	} catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
	}

//Creates the $data[] array which will be turned into JSON
//This array has an object called nodes and an object called links

$data["nodes"] = $nodes;
$data["links"] = array();

$linksCounter = 0;



//The following iterative block creates the links data


for($i = 0; $i < count($data['nodes']); $i++){
    unset($experts);
    $experts = [];

    if ($data['nodes'][$i]['group'] == 0){
        $sourceID = $data['nodes'][$i]['id'];
        $q1 = "SELECT " . "articles.date," . $sourceTable . "." . $sourceRow . ", " . $targetTable . "." . $targetRow . " FROM " . $sourceTable . " JOIN articles JOIN " . $targetTable . " ON " . $sourceTable . ".article = articles.id AND " . $targetTable . ".article = articles.id WHERE " . $sourceTable . "." . $sourceRow . " = '$sourceID'";

        try{
            $queryTarget ="SELECT name,id FROM " . $targetList;
            $result = $db->prepare($q1);
            $result->execute();
            foreach ($db->query($q1) as $row){
                for ($l = 0; $l < count($data["nodes"]); $l++){             //iterates through nodes
                    if ($data["nodes"][$l]["group"] == 2){                  //if it's group two (which is the target group)
                        if ($data["nodes"][$l]["id"] == $row[$targetRow]){  //if the id's match
                            $data['links'][$linksCounter]['source'] = $i;
                            $data['links'][$linksCounter]['target'] = $l;
                            $data['links'][$linksCounter]['value'] = 1;
                            $data['links'][$linksCounter]['expertID'] = $row[$targetRow];
                            $data['links'][$linksCounter]['authorID'] = $row[$sourceRow];
                            $data['links'][$linksCounter]['linkDate'] = date('Y', strtotime($row['date']));
                            $linksCounter++;
                        }
                    }
                }
            }
        } catch(PDOException $ex) {
        echo 'Connection failed: ' . $ex->getMessage();
        }
    }
}


$dataJSON = json_encode($data);
$jsonobj = json_decode($dataJSON, TRUE);

echo $dataJSON;

//print_r($jsonobj['nodes'][2]['id']);






?>