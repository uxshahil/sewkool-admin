<?php 

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/report.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$report = new Report($db);

// set navigation
$nav_title = "Report";

// set page headers
$page_title = "Dashboard";
include_once 'layout_header.php';

$stmt = $report->dashboardReportAll('Awaiting Production');
$total_rows = $stmt->rowCount();

echo "<div class='row'>"; 
    echo "<div class='col-md-6'>"; 

    // display the job_card if there are any
    if($total_rows>0){

        echo "<h3>Awaiting Production</h3>";  
    
        echo "<table class='table table-hover table-responsive table-bordered box'>";
            echo "<tr>";
                echo "<th>Job Card No</th>";
                echo "<th>Client</th>";
                echo "<th>Customer</th>";
                echo "<th>Assigned To</th>";
                echo "<th>Qty</th>";
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                extract($row);

                echo "<tr>";
                    echo "<td>{$row['Job Card No']}</td>";
                    echo "<td>{$row['Client']}</td>";
                    echo "<td>{$row['Customer']}</td>";
                    echo "<td>{$row['Assigned To']}</td>";
                    echo "<td>{$row['Qty']}</td>";
                echo "</tr>";
            }
        echo "</table>";
    }
    
    // tell the user there are no Job_Cards
    else{
        echo "<div class='alert alert-danger'>No Job_Cards in Awaiting Production.</div>";
    }

    echo "</div>";
    echo "<div class='col-md-6'>"; 

    $stmt = $report->dashboardReportAll('Production');
    $total_rows = $stmt->rowCount();

    // display the job_card if there are any
    if($total_rows>0){

        echo "<h3>Production</h3>";  
    
        echo "<table class='table table-hover table-responsive table-bordered box'>";
            echo "<tr>";
                echo "<th>Job Card No</th>";
                echo "<th>Client</th>";
                echo "<th>Customer</th>";
                echo "<th>Assigned To</th>";
                echo "<th>Qty</th>";
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                extract($row);

                echo "<tr>";
                    echo "<td>{$row['Job Card No']}</td>";
                    echo "<td>{$row['Client']}</td>";
                    echo "<td>{$row['Customer']}</td>";
                    echo "<td>{$row['Assigned To']}</td>";
                    echo "<td>{$row['Qty']}</td>";
                echo "</tr>";
            }
        echo "</table>";
    }
    
    // tell the user there are no Job_Cards
    else{
        echo "<div class='alert alert-danger'>No Job_Cards in Awaiting Production.</div>";
    }

    echo "</div>";
echo "</div>";

include_once 'layout_footer.php';
?>