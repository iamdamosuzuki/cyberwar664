<?PHP
// This document provides users with ability to edit selected authority table entries. It allows authorized users to delete these entries. It displays the information of the selected entry, including a list of articles that the selected entry is linked to.

// includes database setup and config.php
include 'util.php';
include 'header.php';

//fetches appropriate authority_list table, id of selected entry to edit
	$table = $_GET['table'];
	$id = $_GET['entryid'];
	$name = $_POST['name'];
	$about = $_POST['about'];

//fetches selected entry from authority_list table
	echo	"<div id='container'>";

	echo "Return to <a href='index.php'>main page.</a><br/>";
	echo "Return to <a href='authority.php?table=$table'>edit $table.</a><br/><br/>";
	echo $table;
	try{
		$sql = "SELECT * FROM `$table` WHERE `id`=$id";
		echo "<form action='authority.php?table=$table&update=t&id=$id' method='post' onsubmit='return testConfirm();'>
			 Input entry for table: $table <br/>";
		}	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getMessage();
	}

		foreach ($db->query($sql) as $row){
			// because single quotation mark gets lost in html, this reg ex will replace single quotation, where present, with encoded character. 
			try{
			//calls the function quotefixSing (in util.php), which fixes the single quotation bug, if present. 
				$row['name'] = quotefixSing($row['name']);
			//prints "name" and "about" form and inserts entry information into form. 			
				echo "Name: <input type='text' style='width:300px;' name='name' value='" . $row['name'] . "' required=required/><br/>
				About: <br/><textarea style='width:500px;height:200px;' name='about' required=required>" . $row['about'] . "</textarea><br/>";
			} catch(PDOException $ex){
				echo 'Connection failed: ' . $ex->getMessage();
			}
		}
 	 
//creates new table that draws from correct authority table (authors, actors, etc), not from authority_list table. To be used to list articles linked with selected authority, as below. 	
	try{
		$pattern='/(.+)(_list)/';
		$replacement = '${1}';
		$table2 = preg_replace($pattern, $replacement, $table);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}

// offers submit and delete options
		echo "<input type='submit' value='Submit'/></form>";
		echo "<form action='delete.php?table=$table&id=$id' method='post' onsubmit='return testConfirm();'><input type='submit' value='Delete'/></form>";
	

//lists all articles linked to corresponding authority
	echo "<br/><br/>This entry is linked to the following articles:";
	echo "<br/><table border=1>";	

	try{
		$sql = "SELECT * FROM `$table2` LEFT JOIN (articles) ON (`$table2`.article = articles.id) WHERE `$table2`.id = $id";		
		foreach($db->query($sql) as $row){				
			echo "<tr><td><a href='new_article.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></td><td>" . $row['source'] . "</td><td>" . $row['date'] . "</td><td>" . $row['url'] . "</td></tr>";
		}
	} catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
		}
		
	echo "</table><br/><br/>";
	echo "</div>";
	echo "</body>";
	echo "</html>";
//closes database connection	
	$db = null;
?>