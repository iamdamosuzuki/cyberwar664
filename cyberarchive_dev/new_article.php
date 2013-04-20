<?PHP
// This document allows users to create a new article or edit articles in the database. It allows authorized users to delete article entries. 

//Includes util.php document, which sets up database connection and includes config.php
	include 'util.php';
	
	echo "<body>";
// If article already exists, pulls its already-entered data from various authority tables
	
	if(isset($_GET['temp_id'])){

		try{
			$temp_id = $_GET['temp_id'];
			$query = "SELECT * FROM Inbox WHERE temp_id = $temp_id";
			$result = $db->prepare($query);
			$result->execute();
			$crnt_article = $result->fetch(PDO::FETCH_ASSOC);
			} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}

	if(isset($_GET['id'])){
	//fetches article data with article id
		try{
			$id = $_GET['id'];
			$sql ="SELECT * FROM `articles` WHERE `id`=". $_GET['id'];
			$result = $db->prepare($sql);
			$result->execute();
			$crnt_article = $result->fetch(PDO::FETCH_ASSOC);
			} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}
	}
	//Provides "return to main page" option	
	echo "<a href='index.php'>Return to main page<br/></a><br/>";
	
	//begins submit_data javascript function, which is incorporated into the lines of php below. 
	echo "<script type='text/javascript'>function submit_data(){
	";
	
	//creates an array for each authority table, into which is pushed each selection "option" (i.e. entry in authority table, such as each author, attack, etc.)
	foreach($tables as $table){
		echo $table . "_data = [];
		$('#select2" . $table . " option').each(function()
                {
                   " . $table . "_data.push($(this).val());
                });
		";
	}
	
	// encodes quotation marks to hmtl character to avoid value='""' html bug; sets new variable for title value. 
	echo "var nuTitle = $('#title').val().replace(/'/g, '&#39;');";	
		
	//if the article id is already set (if article is being updated and is not new), passes article id to submit_data.php
	if(isset($id)){
		echo "$.post('submit_article.php?id=";
		echo $id . "'";
	} else {
		//if article is new, passes no id to submit_article.php
		echo "$.post('submit_article.php'";
	}
	echo ",{";
	
	//creates named arrays that correspond to each $table_data array created above. 
	foreach($tables as $table){
		echo $table . ":" . $table . "_data,";
	}
	//locates source, title, data, url, etc., components using their html id tags. 
	echo "title:nuTitle,source:$('#source').val(),date:$('#date').val(),url:$('#url').val(),text:$('#text').val()},function(result){alert('success!');window.location = 'view_articles.php';});}</script>";

	//begins the table. 
	echo"<table border=0>";
	
	//creates $table_list variable, which will be used to pull information from authors_table, attacks_table, etc in the database. 
	foreach ($tables as $table){
		try{
			$table2 = $table . "_list";
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}
	
		//prints out each left-hand "selection box" (i.e. all existing "options" in an authority table that will be selected by the user and moved to the right)
		echo "<tr><td class=formfield>$table: <select multiple id='select1$table' multiple size='10' style='width:400;'>";
		
		try{
			$sql = "SELECT * FROM `$table2` ORDER BY `name`";
			foreach ($db->query($sql) as $row) {
				echo "<option value='". $row['id']. "'";
				echo ">" . $row['name'] . "</option>";
				}
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		echo "</select></td>";
		
		// prints out "selection" buttons: "add", "remove", & "remove all"
		
		echo"<td><a href='#a' class='add' id='moveFunction' reftable='$table'>add &gt;&gt;</a><br/>
		<a href='#a' class='remove' id='moveFunction' reftable='$table'>&lt;&lt; remove</a><br/>
		<a href='#a' class='removeAll' id='moveFunction' reftable='$table'>&lt;&lt; remove all</a></td>";
		
		// prints out right-hand "selected" boxes for each table, i.e. all features that belong to the specific article entry. Items from the first (left-hand) box are moved here using the above selection buttons. 
		echo "<td><select multiple id='select2$table' reftable='$table' multiple size='10' style='width:400;'>";
		// for existing (updated) articles, populates each box with the corresponding data. 
		if(isset($_GET['id'])){
			try{
			$sql ="SELECT * FROM $table2 LEFT JOIN ($table) ON ($table2.id = $table.id) WHERE $table.article = $id ORDER BY `name`"; 
			foreach ($db->query($sql) as $row){
				echo "<option value='". $row['id'] . "'";
				echo ">" . $row['name'] . "</option>";
			}
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
		}
		}
	echo "</select></td></tr>";
	}
	echo "</table>";
	
	//Note that the New York Times is the only current option for source
	//Provides option for article source, title, url, data, and "about" 
	echo"</select><br/>Source: <select id='source'><option value='nyt'>New York Times</option></select><br/>Title:<input type='text' id='title' 
	size='100' value='" . $crnt_article['title'] . "'/>
	<br/>Date(YYYY-MM-DD):<input type='text' id='date' value='" . $crnt_article['date'] . "'/><br/>
	URL:<input type='text' id='url' size='100' value='" . $crnt_article['url'] . 
	"'/><br/>Text: <br/><textarea style='width:500px;height:200px;' id='text'>" . $crnt_article['text'] . 
	"</textarea><br/>";
	

	
	//provides submit and delete options. submit options runs the above-embedded function submit_data() and returns submit_article, which redirects the page. Delete option pulls in delete_article.php, which deletes the article. 
	try{
		echo "<form action='javascript:submit_data()' method='post'><input type='submit' value='Submit'/></form><br/>";
		echo "<form action='delete_article.php?id=$id' method='post' onclick='return testConfirm();'><input type='submit' value='Delete'/></form>";
	
	} catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
	}
	
	echo "</body>";
	//closes database connection
	$db = null;
?>