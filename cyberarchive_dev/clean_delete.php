<?PHP
   //This document deletes all rows in selected authority table that are linked to deleted article ids.
   
   //includes util.php, which configures the database connection. 
   include 'util.php';
   
   //drags selected table over from cleanup.php
   $table = $_GET['table'];

   // deletes lines that are linked to deleted article ids. 
   try{
      $sql = "DELETE FROM $table WHERE $table.article NOT IN (SELECT `id` FROM `articles` WHERE 1)";
      foreach ($db->query($sql) as $row){
            echo $row;
        }
   }catch(PDOException $ex) {
      echo 'Connection failed: ' . $ex->getMessage();
   }

   //prints "table cleaned" message and offers links back to main page.     
   echo "</br>Done!";    
   echo "</br>Return to <a href='index.php'>main page</a>";

   //closes database connection
   $db = null;
?>


