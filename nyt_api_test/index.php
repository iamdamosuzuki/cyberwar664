<?php // SI 664 Nabil Kashyap Cyber Test


session_start();
require_once 'login.php';

$_SESSION['status'] = (isset($_SESSION['status'])) ? $_SESSION['status'] : '';

session_destroy(); 

define('API_KEY', '4f7c037903eb76bfe8cf733b608c4478:11:49914020');
define('API_URL', 'http://api.nytimes.com/svc/search/v1/article?');

if (isset($_POST['search'])){
      $search = mysql_real_escape_string($_POST['search']);
      header('Location: index.php');

  for($i = 0; $i < 10; $i++){
        $params = array(
            'api-key' => API_KEY,
            'query' => "$search",
            'offset' => $i,
            'fields' => 'date, byline, nytd_byline, title, nytd_title, url',
            );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, API_URL . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_GETFIELDS, $data);

        $inf = curl_exec($ch);
        curl_close($ch);

      $output = json_decode($inf, true);

      foreach($output['results'] as $article ){
        // print_r($output['results'][$i]); echo "<br /><br />";}
        mysql_insert_array('Articles', $article);}
      }
      unset($inf);
      unset($output);}

if (isset($_POST['clear'])){
      mysql_query('TRUNCATE TABLE Articles');
      $_SESSION['status'] = 2;
      header('Location: index.php');
      return;
}

include_once 'header.php';

 
echo "<h1>NYT API TEST DATABASE</h1>";

// shows the right message based on the $_SESSION variable then gets rid of the variable
switch($_SESSION['status']){

case 1: echo "<h2 style = 'color:green'>name added</h2>"; break;
case 2: echo "<h2 style = 'color:red'>table cleared</h2>"; break;
case 3: echo "<h2 style = 'color:green'>name updated</h2>"; break;
case 4: echo "<h2 style = 'color:red'>all values required</h2>"; break;

}

// $url = 'http://api.nytimes.com/svc/search/v1/article?format=json&query=cyberwarfare&api-key=4f7c037903eb76bfe8cf733b608c4478:11:49914020';
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// $rs = curl_exec($ch);

echo <<<_OUT
<h2>search</h2>
<form method='post'>
<input  type='text' name='search'><br /><br /> 
<input id='button' type='submit' value='search'>
</form>
<form method='post'>
<input type='hidden' name='clear' value='true'>
<input id='button' type='submit' name='clear' value='clear table'>
</form>
_OUT;




function mysql_insert_array($table, $data, $exclude = array()) {

    $fields = $values = array();

    if( !is_array($exclude) ) $exclude = array($exclude);

    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "$key";
            $values[] = "'" . mysql_real_escape_string($data[$key]) . "'";
        }
    }

    $fields = implode(",", $fields);
    $values = implode(",", $values);

    if( mysql_query("INSERT INTO $table ($fields) VALUES ($values)") ) {
        return array( "mysql_error" => false,
                      "mysql_insert_id" => mysql_insert_id(),
                      "mysql_affected_rows" => mysql_affected_rows(),
                      "mysql_info" => mysql_info()
                    );
    } else {
        print_r(array( "mysql_error" => mysql_error() ));
    }

}

// builds the table based on the database data
echo "<table><tr><th></th><th></th></tr>";

$query = "SELECT * FROM Articles";
$result = mysql_query($query);
if($result){ $rows = mysql_num_rows($result);

  for ($i = 0; $i < $rows ; ++$i){
      $row = mysql_fetch_row($result);
      echo "<tr>";
      for ($j = 0; $j < count($row); ++$j) echo "<td>$row[$j]</td>";
      // echo '<td><a href="edit.php?id=' . htmlentities($row[2]) .'">edit</a> /';
      // echo ' <a href="delete.php?id=' . htmlentities($row[2]) . '">delete</a></td>';
  }}

echo "</table>";

// foreach($output['results'][$i] as $key=>$item){
//     echo $key . ": "; print_r($item);
//     echo "<br /><br />";
//     $q1 = "INSERT INTO Articles($key) VALUES('$item') WHERE ";
//     // mysql_query($q1);
//     // unset($q1);
//     }} 


  // $query = "INSERT INTO geodata(date, byline, nytd_byline, title, nytd_title, des_facet, nytd_des_facet, url) 
  //         VALUES ('$location','$lat','$lng')";

  // $result = curl_exec($ch);
  // $info = curl_getinfo($ch);
  // curl_close($ch);
  // $data = json_decode($result, true);
  // print_r($data);

// $n = 10;
// $i = 0;
// do{
//   $start = $i * $n;
//   print "$start\n";
  
//   $params = array(
//     'api-key' => API_KEY,
//     'query' => 'des_facet:[SCIENCE AND TECHNOLOGY]',
//     'offset' => $i,
//     'fields' => 'date,byline,url,des_facet',
//     );
//   $data = file_get_contents(API_URL . '/article?' . http_build_query($params));
//   print_r($data);

//   // foreach ($data->results as $item){}
//   //   echo json_decode($item, JSON_PRETTY_PRINT);}   
//     // $jdata = json_encode($item, JSON_PRETTY_PRINT);    // file_put_contents(sprintf('articles/%s.js', md5($item->url)), json_encode($item)); 
//     // echo $jdata;}

//   sleep(1);
// } while (++$i < 5);

?>