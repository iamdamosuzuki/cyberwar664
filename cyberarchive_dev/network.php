<?php // generates a D3 force-directed graph from selected variables

session_start();

//This first chunk of code uses the POST data to set the selection 
//of the dropdown menus


if (isset($_POST['sourceTable'])){
    $sourceTable = $_POST['sourceTable'];
}
else{
    $sourceTable = 'authors';
}

if (isset($_POST['sourceTable'])){
    $targetTable = $_POST['targetTable'];
}
else{
    $targetTable = 'experts';
}



switch($sourceTable)
{
    case 'actors';
        $sourceDrop = "<select name='sourceTable' /><option value='authors'>Authors</option><option value='attacks'>Attacks</option><option value='actors' selected='selected'>Actors</option><option value='experts'>Experts</option><option value='tech'>Technologies</option></select>";
        break;
    case 'attacks';
        $sourceDrop = "<select name='sourceTable' /><option value='authors'>Authors</option><option value='attacks' selected='selected'>Attacks</option><option value='actors'>Actors</option><option value='experts'>Experts</option><option value='tech'>Technologies</option></select>";
        break;
    case 'authors';
        $sourceDrop = "<select name='sourceTable' /><option value='authors' selected='selected'>Authors</option><option value='attacks'>Attacks</option><option value='actors'>Actors</option><option value='experts'>Experts</option><option value='tech'>Technologies</option></select>";
        break;
    case 'experts';
        $sourceDrop = "<select name='sourceTable' /><option value='authors'>Authors</option><option value='attacks'>Attacks</option><option value='actors'>Actors</option><option value='experts' selected='selected'>Experts</option><option value='tech'>Technologies</option></select>";
        break;
    case 'tech';
        $sourceDrop = "<select name='sourceTable' /><option value='authors'>Authors</option><option value='attacks'>Attacks</option><option value='actors'>Actors</option><option value='experts'>Experts</option><option value='tech' selected='selected'>Technologies</option></select>";
        break;
    break;
}

switch($targetTable)
{
    case 'actors';
        $targetDrop = "<select name='targetTable' /><option value='authors'>Authors</option><option value='attacks'>Attacks</option><option value='actors' selected='selected'>Actors</option><option value='experts'>Experts</option><option value='tech'>Technologies</option></select>";
        break;
    case 'attacks';
        $targetDrop = "<select name='targetTable' /><option value='authors'>Authors</option><option value='attacks' selected='selected'>Attacks</option><option value='actors'>Actors</option><option value='experts'>Experts</option><option value='tech'>Technologies</option></select>";
        break;
    case 'authors';
        $targetDrop = "<select name='targetTable' /><option value='authors' selected='selected'>Authors</option><option value='attacks'>Attacks</option><option value='actors'>Actors</option><option value='experts'>Experts</option><option value='tech'>Technologies</option></select>";
        break;
    case 'experts';
        $targetDrop = "<select name='targetTable' /><option value='authors'>Authors</option><option value='attacks'>Attacks</option><option value='actors'>Actors</option><option value='experts' selected='selected'>Experts</option><option value='tech'>Technologies</option></select>";
        break;
    case 'tech';
        $targetDrop = "<select name='targetTable' /><option value='authors'>Authors</option><option value='attacks'>Attacks</option><option value='actors'>Actors</option><option value='experts'>Experts</option><option value='tech' selected='selected'>Technologies</option></select>";
        break;
    break;
}

echo <<< _OUT

<!DOCTYPE html>
<html lang="en">
<head>
<title>SI664 Cyberwarfare Database</title>
<link rel='stylesheet' type='text/css' media='all' href='static/cyberarchive_back.css'/>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="lib/d3/d3.v3.min.js"></script>

<script>
$(function() {
$( "#slider-range" ).slider({
  range: true,
  min: 0,
  max: 500,
  values: [ 75, 300 ],
  slide: function( event, ui ) {
    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
  }
});
$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
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

<style>

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
  fill: #000;
  stroke: none;
}

</style>

<script>
var width = 960,
    height = 600;

var color = d3.scale.category10();

var force = d3.layout.force()
    .charge(-120)
    .linkDistance(100)
    .size([width, height]);

var svg = d3.select('body').append('svg')
    .attr('width', width)
    .attr('height', height)
    .attr('class', 'network');

var data = 'links.php?sourceTable=$sourceTable&targetTable=$targetTable';
var id1 = '$sourceTable' + 'ID';
var id2 = '$targetTable' + 'ID';
var linksFiltered = [];

d3.json(data, function(error, graph) {

  var k = 0;
  min = 1995;
  max = 2005;
  var visibleNodes = [];

  for (i in graph.links){ 
    if (graph.links[i].linkDate > min && graph.links[i].linkDate < max){         
      linksFiltered[k] = graph.links[i];
      visibleNodes.push(Number(linksFiltered[k][id1]));
      k++;
      }
    }

  for (i in graph.nodes){
    console.log(visibleNodes);
    console.log(visibleNodes.indexOf(graph.nodes[i].id));
    if (visibleNodes.indexOf(graph.nodes[i].id) != -1) {
      graph.nodes[i].visibility = "visible";
      console.log(graph.nodes[i]);
    }

  }

  force
      .nodes(graph.nodes)
      .links(linksFiltered)
      .start();

  var link = svg.selectAll('.link')
      .data(graph.links)
    .enter().append('line')
      .attr('class', 'link')
      .style('stroke-width', function(d) { return Math.sqrt(d.value); });

  var node = svg.selectAll('.node')
      .data(graph.nodes)
    .enter().append('g')
      .attr('class', 'node')
      .attr("visibility", function(d){return d.visibility;});
 
  node.append('circle')
      .attr('r', 5)
      .style('fill', function(d) { return color(d.group) })
      .call(force.drag);
      
  node.append('text')
      .attr('dx', 12)
      .attr('dy', '.35em')
      .text(function(d) { return d.name });

  force.on('tick', function() {
    link.attr('x1', function(d) { return d.source.x; })
        .attr('y1', function(d) { return d.source.y; })
        .attr('x2', function(d) { return d.target.x; })
        .attr('y2', function(d) { return d.target.y; });

    node.attr('transform', function(d) { return 'translate(' + d.x + ',' + d.y + ')'; });

  d3.select("svg.network")
    .style("border", "1px solid #009300")
    .style("margin", "5px 25px 0 25px")
    .style("float", "left");

  });
});

</script>

<div id='netForm'>
<form name='networkInput' action='network.php' method='post' onchange='this.form.submit()'>
    $sourceDrop
    <img src= "static/BlueCircle.png">
    <br/>
    $targetDrop
    <img src= "static/OrangeCircle.png">
    <br/><br/>
    <input type='submit' value='Submit' />
</form>
<br/>
</div>

<p>
  <label for="amount">Price range:</label>
  <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
</p>
 
<div id="slider-range" style="width:250px; align: right;"></div>


</body>
</html>
_OUT;
?>