<?php //NYT API inbox - collects potentially relevant articles from between last login until the current date in a temporary database.

// API key from NYT dev account

include 'util.php';
include 'header.php';

define('API_KEY', '4f7c037903eb76bfe8cf733b608c4478:11:49914020');
define('API_URL', 'http://api.nytimes.com/svc/search/v1/article?');
$table = 'Inbox';
$today = date('Ymd',time());

$_SESSION['status'] = (isset($_SESSION['status'])) ? $_SESSION['status'] : '';

// sets the $last_update variable in the Options table

if(!isset($_SESSION['last_update'])) {

    $sql = "SELECT date FROM Options WHERE id = 1";
    $result = $db->query($sql);
    $result = $result->fetch(PDO::FETCH_ASSOC);
    $last_update = $result['date'];

    if ($today != $last_update) $db->query("UPDATE Options SET date = $today WHERE id = 1");
}

// performs the search if set -- could not find a convenient way to protect being and end date 
if (isset($_POST['search'])){
      $search = $db->quote($_POST['search']);
      $begin_date = mysql_real_escape_string($_POST['begin_date']);
      $end_date = mysql_real_escape_string($_POST['end_date']);
      $begin_date = str_replace('-','', $begin_date);
      $end_date = str_replace('-','', $end_date);

      $j = 1;
      $facet = array(); 


// change the max to reflect how many times to query the API -- returns ten results for each iteration
  for($i = 0; $i < 100; $i++){

// where the magic's at: this establishes the variables construct the query.
        $params = array(
            'api-key' => API_KEY,
            'query' => $search,
            'begin_date' => $begin_date,
            'end_date' => $end_date,
            'offset' => $i,
            'fields' => 'date, byline, nytd_byline, title, nytd_title, url, per_facet, org_facet',
            );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, API_URL . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $inf = curl_exec($ch);
        curl_close($ch);

      $output = json_decode($inf, true);

// takes the results and puts them in the Inbox table
      if(count($output['results']) > 0){

        foreach($output['results'] as $article ){

          foreach($article as $field => $value){

            if($field == 'byline') $author = (strlen($article['byline']) > 0) ? format_name($article['byline']) : 0;
            if(is_array($value)) { 
             
                $article["$field"] = implode(", ", $article["$field"]); 
                $article["$field"] = ucwords(strtolower($article["$field"]));
            }

            $article["$field"] = htmlentities($article["$field"]); 
        }
          mysql_insert_array($db, $table, $article);

// a placeholder for source and text fields that can be filled later          
          $sql = "UPDATE $table SET source='nyt', text='sample text', name=\"" . $author . "\"WHERE temp_id= '$j'";
          $db->query($sql);
          $j++;
                    } }else {break;}
      unset($inf);
      unset($output);
 
    }
}

echo  "<div id='container'>";
echo <<< _FORM
<h1>NYT API INBOX</h1>
<a href="index.php">back</a>
<h2>search</h2>
<form method='post'>
keyword: <input type='text' name='search'>
_FORM;

echo " begin date: <input type='text' value='" . date('Y-m-d', strtotime($last_update)) . "' name='begin_date'>";
echo " end date: <input type='text' value='" . date('Y-m-d', strtotime($today)) . "' name='end_date'>";

echo <<< _FORM2
<br /><br />
<input type='submit' value='search'></form>
<br /><br />
<form method='post'>
<input type='hidden' name='clear' value='true'>
<input type='submit' name='clear' value='clear table'> </form>
<br /><br />
_FORM2;


// builds the table based on the database data
echo "<table border='1'>";

$sql = "SELECT * FROM $table";
$result = $db->prepare($sql);
$result->execute();
$count = 0;



if (isset($_POST['clear'])){
        $db->query("TRUNCATE TABLE $table");
}


if(count($result) > 0){

      $_SESSION['status'] = 1;

      foreach ($db->query($sql) as $article){
            $count = $count + 1;
            echo "<tr>";

            foreach ($article as $key => $value){

              switch($key){
                  case '0': break;
                  case "temp_id": echo '<td>' . $article['temp_id'] . '</td>'; break;
                  case "date": echo '<td>' . date('Y-m-d',strtotime($article['date'])) . '</td>'; break;
                  case "title": {
                    echo "<td>";
                    if($article['nytd_title']) {echo $article['nytd_title'];}
                    else {echo $article['title'];}
                    echo "</td>"; 
                    break;}
                  case "name": echo '<td>' . $article['name'] . '</td>'; break;
                  case "per_facet": echo '<td>' . $article['per_facet'] . '</td>'; break;
                  case "org_facet": echo '<td>' . $article['org_facet'] . '</td>'; break;
                  case "url": echo "<td><a class='iframe' href='" . $article['url'] . "'>URL</a></td>"; break;
              }

          } 
          echo "<td><a href='new_article.php?&temp_id=" . $article['temp_id'] . "'>add</a></td>";
          echo "</tr>";
    }} else { $_SESSION['status'] = 2; }

  switch($_SESSION['status']){

  case 1: echo "<h2 style = 'color:green'>". $count . " results</h2>"; break;
  case 2: echo "<h2 style = 'color:green'> no results </h2>"; break;
  case 3: echo "<h2 style = 'color:green'> table cleared </h2>"; break;
  session_destroy();

  }

// a janky function for formatting the 'byline' field from the NYT JSON
function format_name($name) {
  
  $name = ltrim($name,'By ');
  $name = ucwords(strtolower($name));
  $names = explode(' ', $name);
  
  for($l = 0; $l < count($names); $l++) {
    if($names[$l] == 'And') {unset($names[$l]); $names = array_values($names);}
  }

  if($names){
  switch(count($names)){
      case 0: return 'No Author'; break;
      case 1: return $names[0]; break;
      case 2: return $names[1] . ', ' . $names[0]; break;
      case 3: return $names[2] . ', ' . $names[0] . ' ' . $names[1]; break;
      case 4: return $names[1] . ', ' . $names[0]; break;
      case 5: return $names[1] . ', ' . $names[0]; break;
      case 6: return $names[1] . ', ' . $names[0]; break;
    }}
}

// a function for inserting an array
function mysql_insert_array($db, $table, $data, $exclude = array()) {

    $fields = $values = array();

    if( !is_array($exclude) ) $exclude = array($exclude);

    foreach( array_keys($data) as $key ) {

        if( !in_array($key, $exclude) ) {
            $fields[] = "$key";
            $values[] = $db->quote($data[$key]);
        }
    }

    $fields = implode(",", $fields);
    $values = implode(",", $values);
    $sql = "INSERT INTO $table ($fields) VALUES ($values)";
    // $query = $db->quote($sql);    
    $query = $db->prepare($sql);
    $query->execute();
}

$db = null;
unset($_POST['clear']);
echo "</table>";
echo "</div></body></html>";
?>