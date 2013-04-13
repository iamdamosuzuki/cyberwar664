<?php

$db_hostname = 'localhost';
$db_database = 'cyberwar_test';
$db_username = 'cyberwar';
$db_password = 'cyberwar';

$db = mysql_connect($db_hostname,$db_username, $db_password)
   or die("Here's why we can't connect to the database: " . mysql_error());

mysql_select_db($db_database)
    or die("Here's why we can't select the database: " . mysql_error());

$sourceTable = "authors";
$targetTable = "tech";

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

$querySource = "SELECT name,id FROM " . $sourceList;
$resultSource = mysql_query($querySource);

while ($row = mysql_fetch_array($resultSource, MYSQL_ASSOC)){
	$row['id'] = (int)$row['id'];
	$row['group'] = '0';
	$nodes[]= $row;

}

$queryTarget = "SELECT name,id FROM " . $targetList;
$resultTarget = mysql_query($queryTarget);

while ($row = mysql_fetch_array($resultTarget, MYSQL_ASSOC)){
	$row['id'] = (int)$row['id'];
	$row['group'] = '2';
	$nodes[]= $row;
}

$data["nodes"] = $nodes;
$data["links"] = array();

$linksCounter = 0;

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


for($i = 0; $i < count($data['nodes']); $i++){
    unset($experts);
    $experts = [];

    if ($data['nodes'][$i]['group'] == 0){
//      print_r($data['nodes'][$i]['id']);        //debugging for printing
//      echo "\n";
        $sourceID = $data['nodes'][$i]['id'];
//        echo "sourceID: " . $sourceID . "<br />";
        $q1 = "SELECT " . $sourceTable . "." . $sourceRow . ", " . $targetTable . "." . $targetRow . " FROM " . $sourceTable . " JOIN articles JOIN " . $targetTable . " ON " . $sourceTable . ".article = articles.id AND " . $targetTable . ".article = articles.id WHERE " . $sourceTable . "." . $sourceRow . " = '$sourceID'";
//        $q1 = "SELECT authors.author, experts.expert FROM authors JOIN articles JOIN experts ON authors.article = articles.id AND experts.article = articles.id WHERE authors.author = '$sourceID'";
//        echo "<br />" . $q1 . "<br />";
        $rs1 = mysql_query($q1);
//        $row = mysql_fetch_array($rs1, MYSQL_ASSOC);
        while ($row = mysql_fetch_array($rs1, MYSQL_ASSOC)) {
//            echo "Author: " . $row["author"] . " Expert: " . $row["expert"] . "<br />";
            for ($l = 0; $l < count($data["nodes"]); $l++){         //iterates through nodes
                if ($data["nodes"][$l]["group"] == 2){
                    if ($data["nodes"][$l]["id"] == $row[$targetRow]){
 //                       echo "links: [{source: " . $sourceID . ", target: " . $l . ", value: " . 1 . ", expertID: " . $row[$targetRow] . ", authorID: " . $row[$sourceRow] . "}]} <br />";
                        $data['links'][$linksCounter]['source'] = $i;
                        $data['links'][$linksCounter]['target'] = $l;
                        $data['links'][$linksCounter]['value'] = 1;
                        $data['links'][$linksCounter]['expertID'] = $row[$targetRow];
                        $data['links'][$linksCounter]['authorID'] = $row[$sourceRow];
                        $linksCounter++;
                    }
                }
            }
        }
 //       foreach($row as $expertID) 
 //           echo $expertID;
            //echo $sourceRow . ': '. $sourceID . $targetRow . ': ' . $expertID . "<br /><br />";
    }
}
//         for($j = 0; $j < count($row); $j++){
//             if($article){
//                 $articleID = $article[$j];
//                 $q2 = "SELECT expert FROM experts WHERE article = '$articleID'";
//                 $rs2 = mysql_query($q2);
//                 while ($row2 = mysql_fetch_array($rs2, MYSQL_ASSOC)){
//                     $expert[] = (int)$row2['expert'];
//                 }                  
//                 for($k = 0; $k < count($expert); $k++){ 
                 
//                     for ($l = 0; $l < count($data["nodes"]); $l++){                
                        
//                         if ($data["nodes"][$l]["group"] == 2){

//                             if ($data["nodes"][$l]["id"] == $expert[$k]){
//                                 $data['links'][$linksCounter]['source'] = $i;
//                                 $data['links'][$linksCounter]['target'] = $l;
//                                 $data['links'][$linksCounter]['value'] = 1;
//                                 $data['links'][$linksCounter]['expertID'] = $expert[$k];
//                                 $data['links'][$linksCounter]['authorID'] = $sourceID;
//                                 $linksCounter++;
//                             }
                            
//                         }
                        
//                     }    
                    
//                 }
                
//             }
         
//          }   
    
//     }
    
// }


$dataJSON = json_encode($data);
$jsonobj = json_decode($dataJSON, TRUE);

echo $dataJSON;

//print_r($jsonobj['nodes'][2]['id']);






?>