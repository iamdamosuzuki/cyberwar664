//creates sorting function, which is invoked to sort #select2$table in "add" function below
function sortAlpha(a,b){
    return a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase() ? 1 : -1;
    };

// jquery script to add nonduplicate entries to select2$table, remove an entry from select2$table, and remove all entries from select2$table.

$().ready(function() {
   // adds selected items to "select2$table" (i.e. "selected" options), excluding those entries that already exist in select2$table
    $('.add').click(function() {
        tablename = $(this).attr('reftable');
         $('#select1' + tablename).find('option:selected').each(function(){
            var chosen = $(this).attr('value');
            if (typeof $('#select2' + tablename).find('option[value=' + chosen + ']').val() === "undefined"){
               $(this).clone().appendTo('#select2' + tablename);
               $('#select2' + tablename).html($('option', $('#select2' + tablename)).sort(sortAlpha));
            } else {
               return;
            }
         });        
    });

    //removes single selected entries from select2$table
    $('.remove').click(function() {
        tablename = $(this).attr('reftable');
        return !$('#select2' + tablename + ' option:selected').remove();
    });
    
    //removes all entries (selected or unselected) from select2$table
    $('.removeAll').click(function(){
        tablename = $(this).attr('reftable');
        return !$('#select2' + tablename).find('option').remove();
    })
});
