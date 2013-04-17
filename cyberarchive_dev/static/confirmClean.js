//This document displays "for real?" message to user who is cleaning database. 

function testConfirm()
{
var agree=confirm("For real?");
if (agree)
return true ;
else
return false ;
}