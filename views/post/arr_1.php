 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <div id="curve_chart" style="width: 900px; height: 500px"></div>
 <script type="text/javascript">

    google.charts.load('current', {'packages': ['corechart']});
      
    google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
              var data1 = google.visualization.arrayToDataTable([
                  ['Штат', 'Население'],                 
<? echo $Xmax; ?>
      ]);

      var options1 = {
              title: 'Граница эффективности',
              curveType: 'function',
              legend: {position: 'none'}
              };
              
                  var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart'));
                      
                      chart1.draw(data1, options1);
                      chart1.setSelection([{row: 25, column: 2}]);
              }
              



</script>      
  
              
              
<code><?= __FILE__ ?></code>

<pre>    
<? print_r($Jarr); ?>
</pre>

<pre>    
<? echo $Xmin; ?>
</pre>

<pre>    
<? echo $Xmax; ?>
</pre>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
var data = new google.visualization.DataTable();


data.addColumn('datetime', 'Date1');
data.addColumn('number',   'E2');
data.addColumn('number',   'E3');


data.addRows(3);
data.setCell(0, 0, new Date(2006, 1, 28, 10,30,01));
data.setCell(0, 1, 100 );
data.setCell(0, 2, 200 );
data.setCell(1, 0, new Date(2007, 1, 28, 10,30,01));
data.setCell(1, 1, 10 );
data.setCell(1, 2, 11 );
data.setCell(1, 0, new Date(2008, 1, 28, 10,30,01));
data.setCell(2, 1, 130 );
data.setCell(2, 2, 90 );



        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: 'red'}},
          pointSize: 5 
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
     <div id="chart_div" style="width: 900px; height: 500px;"></div>