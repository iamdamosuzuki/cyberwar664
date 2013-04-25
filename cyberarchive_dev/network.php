<?php // generates a D3 force-directed graph from selected variables

include 'util.php';
include 'header.php';

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

d3.json('links.php?sourceTable=$sourceTable&targetTable=$targetTable', function(error, graph) {
  force
      .nodes(graph.nodes)
      .links(graph.links)
      .start();

  var link = svg.selectAll('.link')
      .data(graph.links)
    .enter().append('line')
      .attr('class', 'link')
      .style('stroke-width', function(d) { return Math.sqrt(d.value); });

  var node = svg.selectAll('.node')
      .data(graph.nodes)
    .enter().append('g')
      .attr('class', 'node');
 
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
<a href='index.php'>Return to main menu</a>
</div>
</body>
</html>
_OUT;
?>