<?php // SI 664 Nabil Kashyap midterm 2.25.13
echo <<<_OUT
<head>
<title>SI664 Cyberwarfare Database</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<style>
body, #button{
font-family: "helvetica neue", helvetica, sans-serif;
font-size: 14px;
color: black;}
body {margin: 100px 150px;}
a{text-decoration: none; color:#000;}
h1{width: 25%; border-bottom: 1px blue dashed;}
table{border: 1px solid;  border-collapse: collapse; text-align: center;}
tr, td{border: 1px solid; padding: 5px; vertical-align: bottom;}
#button{font-size:14px; background: none; border:none; border-bottom:1px blue dashed;}
</style>
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
        $('#select').filterByText($('#textbox'), true);
    });
</script>
</head>
<body>
_OUT;

?>
<!-- 
jQuery(document).ready(function($) {

$( "#chunk" ).autocomplete({

	source:'search.php',
	'open': function(e, ui) {
	            $('.ui-autocomplete').css('top', $("ul.ui-autocomplete").cssUnit('top')[0] + 4);
	            $('.ui-autocomplete').css('left', $("ul.ui-autocomplete").cssUnit('left')[0] - 2);
	        }
	    }).data( "autocomplete" )._renderItem = function( ul, item ) {
	            return $( "<li></li>" ).data( "item.autocomplete", item ).append( "<a>" + item.name + "</a>" ).appendTo( ul );

};
}); -->