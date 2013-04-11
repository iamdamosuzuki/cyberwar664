<?php
include 'header.php';
echo <<<_END
<script>
var width = 960,
    height = 500;

var color = d3.scale.category20();

var force = d3.layout.force()
    .charge(-120)
    .linkDistance(100)
    .size([width, height]);

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height)
    .attr("class", "network");

d3.json("links.php", function(error, graph) {
  force
      .nodes(graph.nodes)
      .links(graph.links)
      .start();
      

  var link = svg.selectAll(".link")
      .data(graph.links)
    .enter().append("line")
      .attr("class", "link")
      .style("stroke-width", function(d) { return Math.sqrt(d.value); });

  var node = svg.selectAll(".node")
      .data(graph.nodes)
    .enter().append("g")
      .attr("class", "node");
 
  node.append("circle")
      .attr("r", 5)
      .style("fill", function(d) { return color(d.group); })
      .call(force.drag);
      
  node.append("text")
      .attr("dx", 12)
      .attr("dy", ".35em")
      .attr("fill","#000")
      .text(function(d) { return d.name });

  force.on("tick", function() {
    link.attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

        
        
  });
});
</script>
<a href='index.php'>Return to main menu</a>
</body>
</html>
_END;
?>