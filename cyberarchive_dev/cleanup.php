<?PHP
    // This document displays a list of rows in the selected authority table that are linked to deleted article ids. Provides user with option to delete these rows, via clean_delete.php.
    
    //includes util.php, which sets up database connection. 
    include 'util.php';
    
    //pulls appropriate table from authority page
    $table = $_GET['table'];

    //slices "list" off of table name in order to work with correct authority table. 
    try{
        $pattern='/(.+)(_list)/';
        $replacement = '${1}s';
        $table2 = preg_replace($pattern, $replacement, $table);
    } catch(PDOException $ex) {
            echo 'Connection failed: ' . $ex->getMessage();
    }

    //pulls and prints list of all rows that are linked to a deleted article id. 
    try{
        $sql = "SELECT * from $table2 WHERE $table2.article NOT IN (SELECT `id` FROM `articles` WHERE 1)";
        foreach ($db->query($sql) as $row){
            echo $row;
        }
    } catch(PDOException $ex) {
        echo 'Connection failed: ' . $ex->getMessage();
        }
    
    // routes user to delete function for above-printed rows. 
    try{
        echo "<script type='text/javascript' src='confirmClean.js'></script>";
        echo "<br/><form action='clean_delete.php?table=$table2' method='post' onsubmit='return testConfirm();'><input type='submit' value='Clean this table'/></form>";
    } catch(PDOException $ex) {
        echo 'Connection failed: ' . $ex->getMessage();
    }
    
    //provides link back to main page    
    echo "<a href='index.php'>Return to main page.</a><br/>";
    
    //closes database connection
	$db = null;

?>