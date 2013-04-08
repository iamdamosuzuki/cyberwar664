<?php
echo <<<_OUT
<!DOCTYPE html>
<html lang="en">
<head>
<title>SI664 Cyberwarfare Database</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="cyberarchive_back.css" />
<script type="text/javascript" src="d3/d3.v3.min.js"></script>
<style type="text/css">
    svg{
        float: right;
        left-margin: 25%;
    }

    svg.network{float:left;}
    div.bar {
        display: inline-block;
        width: 20px;
        height: 75px;
        background-color: teal;
        margin-right: 2px;
    }
    
    #button {
        position: absolute;
        top: 10px;
        left: 400px;
    }
    
    .btn-mini {
        padding: 2px 6px;
        font-size: 11px;
        line-height: 14px;
    }
    .node {
      stroke: #fff;
      stroke-width: 1.5px;
    }

    .link {
      stroke: #999;
      stroke-opacity: .6;
    }

    .node text {
      pointer-events: none;
      font: 10px sans-serif;
      color: #000;
    }

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
</head>
<body>
_OUT;
?>