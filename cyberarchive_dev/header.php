<?php // added a header to better organize our scripts
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>SI664 Cyberwarfare Database</title>
<link rel='stylesheet' type='text/css' media='all' href='static/cyberarchive_back.css'/>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="lib/d3/d3.v3.min.js"></script>
<script type='text/javascript' src='static/moveFunction2.js'></script>
<script type='text/javascript' src='static/confirmDel.js'></script>
<script type='text/javascript' src='static/confirmClean.js'></script>
     
<!-- jquery code for tablesorter function called in view_articles.php -->
<script type='text/javascript' src='static/jquery.tablesorter/jquery-latest.js'></script>
<script type='text/javascript' src='static/jquery.tablesorter/jquery.tablesorter.js'></script>
<script type='text/javascript' src='static/sortTable.js'></script>
 
<script>
    jQuery.fn.filterByText = function(textbox, selectSingleMatch) {
        return this.each(function() {
            var select = this;
            var options = [];
            $(select).find('option').each(function() {
                options.push({value: $(this).val(), text: $(this).text()});
            });
            $(select).data('options', options);
            $(textbox).bind('change keyup', function() {
                var options = $(select).empty().data('options');
                var search = $(this).val().trim();
                var regex = new RegExp(search,"gi");
              
                $.each(options, function(i) {
                    var option = options[i];
                    if(option.text.match(regex) !== null) {
                        $(select).append(
                           $('<option>').text(option.text).val(option.value)
                        );
                    }
                });
                if (selectSingleMatch === true && $(select).children().length === 1) {
                    $(select).children().get(0).selected = true;
                }
            });            
        });
    };

    $(function() {
        $('#authorSelect').filterByText($('#authorBox'), true);
    });

    $(function() {
        $('#attackSelect').filterByText($('#attackBox'), true);
    });

    $(function() {
        $('#actorSelect').filterByText($('#actorBox'), true);
    });

    $(function() {
        $('#expertSelect').filterByText($('#expertBox'), true);
    });

    $(function() {
        $('#techSelect').filterByText($('#techBox'), true);
    });

</script>

<link rel="stylesheet" type='text/css' href="lib/colorbox.css" />
<script src="lib/jquery.colorbox.js"></script>
<script>
  $(document).ready(function(){
    //Examples of how to assign the Colorbox event to elements
    $(".group1").colorbox({rel:'group1'});
    $(".group2").colorbox({rel:'group2', transition:"fade"});
    $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
    $(".group4").colorbox({rel:'group4', slideshow:true});
    $(".ajax").colorbox();
    $(".youtube").colorbox({iframe:true, innerWidth:425, innerHeight:344});
    $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
    $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
    $(".inline").colorbox({inline:true, width:"50%"});
    $(".callbacks").colorbox({
      onOpen:function(){ alert('onOpen: colorbox is about to open'); },
      onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
      onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
      onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
      onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    $('.non-retina').colorbox({rel:'group5', transition:'none'})
    $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
    
    //Example of preserving a JavaScript event for inline calls.
    $("#click").click(function(){ 
      $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
      return false;
    });
  });
</script>

</head>
<body>

<div id='header'><h1><a href='index.php'>THE CYBERWAR DIGITAL ARCHIVE</a></h1>
<ul>
<li><a href='new_article.php'>New Article</a><br/>
<li><a href='view_articles.php'>Articles</a></li>
<li><a href='authority.php?table=author_list'>Authors</a></li>
<li><a href='authority.php?table=tech_list'>Techs</a></li>
<li><a href='authority.php?table=expert_list'>Experts</a></li>
<li><a href='authority.php?table=attack_list'>Attacks</a></li>
<li><a href='authority.php?table=actor_list'>Actors</a></li>
</ul>
<a href='index.php'><img src='static/sad_mac.png' /></a>
</div>