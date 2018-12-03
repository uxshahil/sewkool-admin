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

echo "<div id='slides'>";

    echo "<div class='row slide showing'>"; 
        echo "<div class='col-md-12'><h1>All</h1></div>";
        echo "<div class='col-md-6'>"; 

        $stmt = $report->dashboardReportAll('Awaiting Production');
        $total_rows = $stmt->rowCount();

        // display the job_card if there are any
        if($total_rows>0){

            echo "<h3>Awaiting Production - {$total_rows}</h3>";  
        
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

            echo "<h3>Production - {$total_rows}</h3>";  
        
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

    $stmt = $report->dashboardReportAssignedToUsers();
    $total_rows = $stmt->rowCount();

    // display the job_card if there are any
    if($total_rows>0){

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $stmt_2 = $report->dashboardReportUser("Awaiting Production",$row['id']);
            $total_rows_2 = $stmt_2->rowCount();

            echo "<div class='row slide'>"; 
                echo "<div class='col-md-12'><h1>{$row['first_name']} {$row['last_name']}</h1></div>";
                echo "<div class='col-md-6'>"; 

                    echo "<h3>Awaiting Production - {$total_rows_2}</h3>";  
            
                    echo "<table class='table table-hover table-responsive table-bordered box'>";
                        echo "<tr>";
                            echo "<th>Job Card No</th>";
                            echo "<th>Client</th>";
                            echo "<th>Customer</th>";
                            echo "<th>Assigned To</th>";
                            echo "<th>Qty</th>";
                        echo "</tr>";

                        while ($row_2 = $stmt_2->fetch(PDO::FETCH_ASSOC)){
                        
                            extract($row_2);
        
                            echo "<tr>";
                                echo "<td>{$row_2['Job Card No']}</td>";
                                echo "<td>{$row_2['Client']}</td>";
                                echo "<td>{$row_2['Customer']}</td>";
                                echo "<td>{$row_2['Assigned To']}</td>";
                                echo "<td>{$row_2['Qty']}</td>";
                            echo "</tr>";
                        }
                    echo "</table>";

                echo "</div>";
            

                $stmt_2 = $report->dashboardReportUser("Production",$row['id']);
                $total_rows_2 = $stmt_2->rowCount();

                echo "<div class='col-md-6'>"; 

                    echo "<h3>Production - {$total_rows_2}</h3>";  
                
                    echo "<table class='table table-hover table-responsive table-bordered box'>";
                        echo "<tr>";
                            echo "<th>Job Card No</th>";
                            echo "<th>Client</th>";
                            echo "<th>Customer</th>";
                            echo "<th>Assigned To</th>";
                            echo "<th>Qty</th>";
                        echo "</tr>";

                        while ($row_2 = $stmt_2->fetch(PDO::FETCH_ASSOC)){
                        
                            extract($row_2);
        
                            echo "<tr>";
                                echo "<td>{$row_2['Job Card No']}</td>";
                                echo "<td>{$row_2['Client']}</td>";
                                echo "<td>{$row_2['Customer']}</td>";
                                echo "<td>{$row_2['Assigned To']}</td>";
                                echo "<td>{$row_2['Qty']}</td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                echo "</div>";
            echo "</div>";
        }
    }

echo "</div>";

include_once 'layout_footer.php';
?>