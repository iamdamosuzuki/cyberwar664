<?php

//NYT API inbox - collects potentially relevant articles from between last login until the current date in a temporary database.

include_once 'config.php';

// API key from NYT dev account
define('API_KEY', '4f7c037903eb76bfe8cf733b608c4478:11:49914020');
define('API_URL', 'http://api.nytimes.com/svc/search/v1/article?');
$table = 'Inbox';

if (isset($_POST['search'])){
      $search = mysql_real_escape_string($_POST['search']);

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
        mysql_insert_array($table, $article);}
      }
      unset($inf);
      unset($output);}

include_once 'header.php';

if (isset($_POST['clear'])){
      mysql_query("TRUNCATE TABLE $table");
      header('Location: inbox.php');
      return;
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

echo "<h1>NYT API TEST DATABASE</h1>";

echo <<<_OUT
<h2>search</h2>
<form method='post'>
<input  type='text' name='search'><br /><br /> 
<input id='button' type='submit' name='search' value='search'>
</form>
<form method='post'>
<input type='hidden' name='clear' value='true'>
<input id='button' type='submit' name='clear' value='clear table'>
</form>
_OUT;

// builds the table based on the database data
echo "<table border='1'>";

$query = "SELECT * FROM $table";
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

?>