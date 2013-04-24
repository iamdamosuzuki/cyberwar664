//This function initializes the "accordion" js function in mergeAuth.php

  $(function() {
    $("#accordion").accordion({
      collapsible: true,
      active: false,
      heightStyle: "content"});
    $('h3').click(function(){
      $('html, body').animate({ scrollTop: 0 }, 0);
    });
  });
