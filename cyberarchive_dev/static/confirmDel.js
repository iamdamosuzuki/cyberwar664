// this document displays "are you sure?" message to user who is deleting information from database.

function testConfirm()
{
var agree=confirm("Are you sure?");
if (agree)
return true ;
else
return false ;
}