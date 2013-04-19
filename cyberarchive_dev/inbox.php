<?php
include 'util.php';

//NYT API inbox - collects potentially relevant articles from between last login until the current date in a temporary database.

// API key from NYT dev account
define('API_KEY', '4f7c037903eb76bfe8cf733b608c4478:11:49914020');
define('API_URL', 'http://api.nytimes.com/svc/search/v1/article?');
$table = 'Inbox';
$today = date('Ymd',time());
// echo $last_update;

$query = "SELECT date FROM Options WHERE id = 1";
$result = mysql_query($query);
$last_update = mysql_fetch_array($result)['date'];

$last_update = 20130320;

if ($today != $last_update) mysql_query("UPDATE Options SET date = $today WHERE id = 1");

// mysql_query("INSERT INTO Options(date) VALUES $last_update"); echo'chunks';

// var_dump(mysql_fetch_array($result));


if (isset($_POST['search'])){
      $search = mysql_real_escape_string($_POST['search']);

  for($i = 0; $i < 10; $i++){
        $params = array(
            'api-key' => API_KEY,
            'query' => $search,
            'begin_date' => $last_update,
            'end_date' => $today,
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
        mysql_insert_array($table, $article);}
      }
      unset($inf);
      unset($output);}

if (isset($_POST['clear'])){
      mysql_query("TRUNCATE TABLE $table");
      echo "<br><h2>table cleared</h2></br>";
}

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

// test code for a simple keyword search function
echo "<h1>NYT API TEST DATABASE</h1>";
echo "<h2>search</h2>";
echo "<form method='post'>";
echo "<input type='text' name='search'>";
echo "<input type='submit' value='search'></form><br /><br />";
echo "<form method='post'>";
echo  "<input type='hidden' name='clear' value='true'>";
echo  "<input id='button' type='submit' name='clear' value='clear table'> </form>";

// builds the table based on the database data
echo "<table border='1'>";

$query = "SELECT * FROM $table";
$result = mysql_query($query);
if($result){ $rows = mysql_num_rows($result);

  for ($j = 0; $j < $rows ; ++$j){

      $row = mysql_fetch_row($result);
      echo "<tr>";
      for ($k = 0; $k < count($row); ++$k){
        switch($k){
          case 0: echo "<td>$row[$k]</td>"; break;
          case 1: echo '<td>' . date('Y-m-d',strtotime($row[$k])) . '</td>'; break;
          case 2: echo '<td>' . format_name($row[$k]) . '</td>'; break;
          case 3: echo "<td>$row[$k]</td>"; break;
          case 4: break;
          case 5: echo "<td>$row[$k]</td>"; break;
          case 6: echo "<td>$row[$k]</td>"; break;
          case 7: echo "<td>$row[$k]</td>"; break;
          case 8: echo "<td><a class='iframe' href='$row[$k]'>URL</a></td>"; $url[] = $row[$k]; break;
        }
      }
      echo "<td><form method='post'>
            <input type='submit' name='add' value='add'>
            <input type='hidden' name='id' value='$row[0]'>
            <input type='hidden' name='date' value='$row[1]'>
            <input type='hidden' name='name' value='$row[2]'>
            <input type='hidden' name='title' value='$row[3]'>
            <input type='hidden' name='url' value='$row[4]'>
            </form></td>";
      }
    }


function format_name($name) {
  
  $name = ltrim($name,'By ');
  $name = ucwords(strtolower($name));
  $names = explode(' ', $name);
  
  for($l = 0; $l < count($names); $l++) {
    if($names[$l] == 'And') {unset($names[$l]); $names = array_values($names);}
  }

  if($names){
  switch(count($names)){
      case 0: return ''; break;
      case 1: return $names[0]; break;
      case 2: return $names[1] . ', ' . $names[0]; break;
      case 3: return $names[2] . ', ' . $names[0] . ' ' . $names[1]; break;
      case 4: return $names[1] . ', ' . $names[0]; break;
      case 5: return $names[1] . ', ' . $names[0]; break;
      case 6: return $names[1] . ', ' . $names[0]; break;
    }}else{return 'chunks';}

  // return implode(' ', $names);
}

echo "</table>";
unset($_POST['clear']);
?>