<?PHP

//note that the order of html elements on this page -- h3 & divs -- are necessary for accordion.js to run correctly. rearrange with care!! 

 //includes util.php, which sets up database connection and includes list of authorized users
    include 'util.php';
    //style sheet and jquery code for accordion function in mergeAuth.php; 
     echo"<link rel='stylesheet' href='http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css' />";
     echo "<script src='http://code.jquery.com/jquery-1.9.1.js'></script>";
     echo "<script src='http://code.jquery.com/ui/1.10.2/jquery-ui.js'></script>";
     echo "<script type='text/javascript' src='accordion.js'></script>";
     
    // jquery redirect code for mergeAuth.php -> mergeAuth2.php
     echo "<script type='text/javascript' src='jquery.redirect.min.js'> </script>";
     
    
    // creates embedded javascript function "merge_data_$table", which passes selected titles (From boxes below) to merge_auth2.php.     
    foreach ($tables as $table){
    echo "<script type='text/javascript'>function merge_data_".$table."(){";
	//echo "tablename = $(this).attr('reftable');";
	echo $table . "_data = [];
		$('#select2" . $table . " option').each(function()
                {
                   " . $table . "_data.push($(this).val());
                });";
    //this part of the function redirects the page to merge_Auth2.php with the passed variables. it's dependent upon redirect.min.js, embedded in util.php. 
	echo "$().redirect('mergeAuth2.php', {'table':" . $table . "_data, 'table2':'" . $table . "' });}</script>";
    }
    //begins html elements, required for accordion.js. 
    echo "<html>";
    
    //prints links to return to admin or main pages
    echo "Return to <a href='index.php'>main page.</a><br>";
    echo "Return to <a href='admin.php'>admin page.</a><br><br>";
    
    //begins table selection process
    echo "Select a table to merge:<br><br>";
    
    //begins jquery accordion formatting
    echo "<div id='accordion'>";
    
    // prints each table as an "h3" component of the jquery accordion script
    foreach($tables as $table){	
	echo "<h3>" . $table . "</h3>";
        echo "<div>";
	//begins a table that will print out all existing authority data for each table; selection boxes will allow for merging. 
	    echo"<table border=0>";
	    $table2 = $table . "_list";
	    //prints out each left-hand "selection box" (i.e. all existing "options" in an authority table that will be selected by the user and moved to the right. 
	    echo "<tr><td class=formfield><select multiple id='select1$table' multiple size='10' style='width:400;'>";
		
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
		
		// prints out empty right-hand selection box, into which authority data to be merged will be moved. 
		echo "<td><select multiple id='select2$table' reftable='$table' multiple size='10' style='width:400;'>";
	echo "</select></td></tr>";
	echo "</table>";
	
	// submits the data to be merged from this selection box by calling merge_data() function. 
	echo "<form action='javascript:merge_data_".$table."()' method='post'><input type='submit' value='Begin merging this data.'/></form><br/>";
	echo "</div>";
    }
    
    echo "</div>";
    echo "</body>";
    echo "</html>";
    
    //closes database connection
    $db = null; 
    

?>