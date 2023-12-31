<!DOCTYPE html>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
 
    <script type="text/javascript" src="{{ url('/') }}/js/d3.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/d3.geo.min.js"></script>

    <!--  Styles  -->
    <link type="text/css" rel="stylesheet" href="{{ url('/') }}/css/index.css"/>

    
</head>
<body>
     <div id="chart"></div>
     <script>
          var w = 600;   
var h = 650;   
var proj = d3.geo.mercator();    
var path = d3.geo.path().projection(proj);    
var t = proj.translate(); // the projection's default translation    
var s = proj.scale() // the projection's default scale     
var svg = d3.select("#chart")  
   .append("svg:svg")             
   .attr("width", w)        
   .attr("height", h)
   .call(initialize);   
  
var map = svg.append("svg:g")      
var india = map.append("svg:g")
        .attr("id", "india")
        .style('stroke','#000')
        .style('stroke-width','0.5'); 
function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
          color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
   }
d3.json("{{ url('/') }}/data-1.json", function (json) {
         india.selectAll("path")
         .data(json.features)
         .enter().append("path")
         .attr("d", path)
         .style("fill",function(){
            return getRandomColor();
          })
          .on("mouseover", handleMouseOver)
          .on("mouseout", handleMouseOut)
          .append("title")
          .text(function(d){
           return "State : " + d.id+"\n Here goes the state data"; 
          });
aa = [ 80.9462, 26.8467 ];      // add circles to svg 
india.selectAll("circle")
      .data([aa]).enter()
      .append("circle")
      .attr("cx", function (d) {
     //    console.log(proj(d));
        return proj(d)[0];
      })
      .attr("cy", function (d) {
        return proj(d)[1];
       })
      .attr("r", "3px")
      .attr("fill", "black")
      .on("mouseover", function(){
          d3.select(this).attr("r","6px").style('fill',"orange")
       })
       .on("mouseout", function() {  
          d3.select(this)
            .attr("r","3px")
            .style("fill",'black')
        })
        .append("title")
        .text(function(d){
          return "City : " + "Lucknow"+"\n Here goes the City data";
         })
     });
 function handleMouseOver() {
  d3.select(this).attr("stroke-width","1.4");
//   console.clear();
//   console.log(this);
 }
 function handleMouseOut() {
  d3.select(this).attr("stroke-width","0.5")
 }
 function initialize() 
 {      
    proj.scale(6700);
    proj.translate([-1240, 750]);
 }
     </script>
</body>
</html>