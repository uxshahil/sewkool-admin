<?php

// inlcude dtaabase and object files
include_once 'config/database.php';
include_once 'objects/report.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$report = new Report($db);

?>

<div class="col-md-12" id="barchart_material" style="width: 800px; height: 300px;"></div>

<?php 
$stmt = $report->statusReport("All");
$row_count = $stmt->rowCount();

if ($row_count > 0) {
?>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        

        // Load google charts
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Status', 'Total'],
        <?php 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
            echo "['".$row['title']."',".$row['total']."],";
        }?>]);

        // Optional; add a title and set the width and height of the chart
        var options ={
          chart:{   title: 'Status Summary',
                    subtitle: '' },
          bars: 'horizontal', // Required for Material Bar Charts.
          bar: { groupWidth: "37%" },
          chartArea: { backgroundColor: "#f4f4f4"},
          backgroundColor: { fill: "#f4f4f4"}
        };


        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        
    </script>

<?php
}
else{
    echo "No Data";
}
?>