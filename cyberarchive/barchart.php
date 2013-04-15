<?php
echo <<<_OUT
<script type="text/javascript">
            
			//Width and height
			var w = 500;
			var h = 400;
			var barPadding = 1;
			
			var dataset;
			var datanames;
			
		
            
            d3.json("bars.php", function(json) {
              dataset = json.count;
              datanames = json.name;
              datacolor = json.color;
              generateVis();
            });
			
			//Create SVG element

						
						
            function generateVis(){
            
                h = d3.max(dataset) + 50;
                
                console.log(datacolor);
                
                var chart = d3.select("body")
                            .append("svg")
                            .attr("width", w + 30)
                            .attr("height", h);
                    
                    var x = d3.scale.ordinal()
                        .domain(dataset)
                        .rangeBands([0, w + 30]);	
                        
                    var y = d3.scale.linear()
                        .domain([0, d3.max(dataset)])
                        .range([0, h]);
                
                    chart.selectAll("rect")
                       .data(dataset)
                       .enter()
                       .append("rect")
                       .attr("x", function(d, i) {
                            return i * (w / dataset.length) + 30;
                       })
                       .attr("y", function(d) {
                            return h - (d);
                       })
                       .attr("width", w / dataset.length - barPadding)
                       .attr("height", function(d) {
                            return d * 4;
                       });
                       
                    chart.selectAll("rect")
                       .data(datacolor)
                       .attr("fill", function(d) {
                            return d;
                       });
        
                    chart.selectAll("text.inbar")
                       .data(datanames)
                       .enter().append("text")
                           .text(function(d) {
                                return d;
                           })
                           .attr("text-anchor", "middle")
                           .attr("x", function(d, i) {
                                return i * (w / dataset.length) + (w / dataset.length - barPadding) / 2 + 30;
                           })
                           .attr("y", function(d) {
                                return h - 5;
                           })
                           .attr("font-family", "sans-serif")
                           .attr("font-size", "11px")
                           .attr("fill", "white")
                           .attr("class", "inbar");
    
    
                    chart.selectAll("text.ticks")
                       .data(dataset)
                       .enter().append("text")
                           .text(function(d) {
                                return d;
                           })
                           .attr("text-anchor", "middle")
                           .attr("x", function(d, i) {
                                return i * (w / dataset.length) + (w / dataset.length - barPadding) / 2 + 30;
                           })
                           .attr("y", function(d) {
                                return h - (d + 5);
                           })
                           .attr("font-family", "sans-serif")
                           .attr("font-size", "11px")
                           .attr("fill", "black")
                           .attr("class", "ticks");
    
                       
                    chart.selectAll("line")
                        .attr("x1", 0)
                        .attr("x2", w + 30)
                        .attr("y1", h)
                        .attr("y2", h)
                        .style("stroke", "#000");
    
                    chart.append("line")
                        .attr("x1", 0)
                        .attr("x2", w + 30)
                        .attr("y1", h - 1)
                        .attr("y2", h - 1)
                        .style("stroke", "#fff");
             
                    chart.append("line")
                        .attr("x1", 31)
                        .attr("x2", 31)
                        .attr("y1", 0)
                        .attr("y2", h)
                        .style("stroke", "#fff");
    
      
                    chart.append("line")
                        .attr("x1", 0)
                        .attr("x2", w + 30)
                        .attr("y1", h)
                        .attr("y2", h)
                        .style("stroke", "#000");
                        
                    chart.append("line")
                        .attr("x1", 30)
                        .attr("x2", 30)
                        .attr("y1", 0)
                        .attr("y2", h)
                        .style("stroke", "#000");


			   }

        </script>
_OUT;
?>