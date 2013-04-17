<?PHP
// This document provides authorized users with option to delete selected authority table entries.

//include util.php document, which sets up database connection and includes config.php
	include 'util.php';
// determines if user is authorized to perform task. 
	try{
		delAuth($authSuperUsers);
	} catch(PDOException $ex) {
		echo 'Connection failed: ' . $ex->getMessage();
		}

//fetches appropriate authority_list table
	$table = $_GET['table'];
//fetches entry id to be deleted.
	$id = $_GET['id'];


//deletes selected entry from authority_list table	
	try{
	$sql = "DELETE FROM `$table` WHERE `id` = $id";
	$result = $db->query($sql);
	} catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
	}

//slices authority_list into authority (i.e. author_list to authors) and creates new table variable
	try{
		$pattern='/(.+)(_list)/';
		$replacement = '${1}';
		$table2 = preg_replace($pattern, $replacement, $table);
		} catch(PDOException $ex) {
			echo 'Connection failed: ' . $ex->getMessage();
			}
// deletes selected entry from the above-called authority table ($table2). 
	try{
	$sql = "DELETE FROM `$table2` WHERE `id` = $id";
	$result = $db->query($sql);
	} catch(PDOException $ex) {
	echo 'Connection failed: ' . $ex->getMessage();
	}
	
//prints "entry deleted" statement	
	echo "Entry deleted.</br>Return to <a href='authority.php?table=$table'>edit $table</a>";
	echo "</br>Return to <a href='index.php'>main page</a>";

//closes database connection. 
	$db = null;
?>