//initiates table sorting functions outlined in jquery.tablesorter; this function called in view_articles.php. Set to sort by column 2 (date) and then by column 0 (title)

$(document).ready(function() 
    { 
        $("#myTable").tablesorter( {sortList: [[2,0], [0,0]]} ); 
    } 
); 
    