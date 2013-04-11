<?php

$db_hostname = 'localhost';
$db_database = 'cyberwar_test';
$db_username = 'cyberwar';
$db_password = 'cyberwar';

$db = mysql_connect($db_hostname,$db_username, $db_password)
   or die("Here's why we can't connect to the database: " . mysql_error());

mysql_select_db($db_database)
    or die("Here's why we can't select the database: " . mysql_error());


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
	$row['group'] = '2';
	$nodes[]= $row;
}

$data["nodes"] = $nodes;
$data["links"] = array();

$linksCounter = 0;

for($i = 0; $i < count($data['nodes']); $i++){
    unset($experts);
    $experts = [];

    if ($data['nodes'][$i]['group'] == 0){
//      print_r($data['nodes'][$i]['id']);        //debugging for printing
//      echo "\n";
        $sourceID = $data['nodes'][$i]['id'];
        $q1 = "SELECT authors.author, experts.expert FROM authors JOIN articles JOIN experts ON authors.article = articles.id AND experts.article = articles.id WHERE authors.author = '$sourceID'";
        $rs1 = mysql_query($q1);
        $row = mysql_fetch_array($rs1, MYSQL_ASSOC);
        foreach($row as $expertID) echo 'author: '. $sourceID . '+ expert: ' . $expertID . "<br /><br />";

}    }
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