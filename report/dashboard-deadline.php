<?php 

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude database and object files
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
?>

<div class="container">

    <div class="row">

        <div class="col-12">

            <?php 

                $stmt = $report->dashboardDeadlineReport(0);
                $total_rows = $stmt->rowCount();

                if($total_rows>0){

                echo "<h3>Due Today / Overdue [{$total_rows}]</h3>";  
                
                echo "<table class='table table-hover table-responsive table-bordered box'>";
                    echo "<tr>";
                        echo "<th>Job Card No</th>";
                        echo "<th>Client</th>";
                        echo "<th>Customer</th>";
                        echo "<th>Status</th>";
                        echo "<th>Created On</th>"; 
                        echo "<th>Deadline</th>";                        
                        echo "<th>Days Left</th>";
                        echo "<th>Quantity</th>";
                    echo "</tr>";
                
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        extract($row);                        
                
                        if ($row['deadline_enforce'] == 1) {
                            echo "<tr class='light-warning-bg'>";    
                        }
                        else {
                            echo "<tr>";
                        }

                        echo "<td>";
                            echo "<a href='{$home_url}job_card_process/read_one.php?id={$row['id']}'>";
                                echo "<div style='height:100%;width:100%''>";
                                    echo "{$row['id']}";
                                echo "</div>";
                            echo "</a>";
                        echo "</td>";
                        echo "<td>{$row['Client']}</td>";
                        echo "<td>{$row['Customer']}</td>";
                        echo "<td>{$row['Status']}</td>";
                        echo "<td>" . date("j F Y", strtotime($row['Created'])) ."</td>";
                        echo "<td>" . date("j F Y", strtotime($row['Deadline'])) ."</td>";
                        echo "<td>{$row['Days Left']}</td>";                            

                        $stmt_sub = $report->dashboardDeadlineReportCountQuantity($row['id']);
                        $total_rows_sub = $stmt_sub->rowCount();
                    
                        if ($total_rows_sub > 0 ){
                            
                            while ($row_sub = $stmt_sub->fetch(PDO::FETCH_ASSOC)){
                                        
                                extract($row_sub);       
                                echo "<td>{$row_sub['Count']}</td>";

                            }
                        }

                        echo "</tr>";
                    }
                echo "</table>";
                }

            ?>

        </div>

        <div class="col-12">

            <?php 

                $stmt = $report->dashboardDeadlineReport(1);
                $total_rows = $stmt->rowCount();

                if($total_rows>0){

                echo "<h3>Less than 3 days [{$total_rows}]</h3>";  

                echo "<table class='table table-hover table-responsive table-bordered box'>";
                    echo "<tr>";
                        echo "<th>Job Card No</th>";
                        echo "<th>Client</th>";
                        echo "<th>Customer</th>";
                        echo "<th>Status</th>";
                        echo "<th>Created On</th>"; 
                        echo "<th>Deadline</th>";
                        echo "<th>Days Left</th>";
                        echo "<th>Quantity</th>";
                    echo "</tr>";

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        extract($row);

                        if ($row['deadline_enforce'] == 1) {
                            echo "<tr class='light-warning-bg'>";    
                        }
                        else {
                            echo "<tr>";
                        }

                        echo "<td>";
                            echo "<a href='{$home_url}job_card_process/read_one.php?id={$row['id']}'>";
                                echo "<div style='height:100%;width:100%''>";
                                    echo "{$row['id']}";
                                echo "</div>";
                            echo "</a>";
                        echo "</td>";
                        echo "<td>{$row['Client']}</td>";
                        echo "<td>{$row['Customer']}</td>";
                        echo "<td>{$row['Status']}</td>";
                        echo "<td>" . date("j F Y", strtotime($row['Created'])) ."</td>";
                        echo "<td>" . date("j F Y", strtotime($row['Deadline'])) ."</td>";
                        echo "<td>{$row['Days Left']}</td>";                        

                        $stmt_sub = $report->dashboardDeadlineReportCountQuantity($row['id']);
                        $total_rows_sub = $stmt_sub->rowCount();
                    
                        if ($total_rows_sub > 0 ){
                            
                            while ($row_sub = $stmt_sub->fetch(PDO::FETCH_ASSOC)){
                                        
                                extract($row_sub);       
                                echo "<td>{$row_sub['Count']}</td>";

                            }
                        }
                        echo "</tr>";
                    }
                echo "</table>";
                }

            ?>

        </div>

        <div class="col-12">

            <?php 

                $stmt = $report->dashboardDeadlineReport(2);
                $total_rows = $stmt->rowCount();

                if($total_rows>0){

                echo "<h3>More than 3 days [{$total_rows}]</h3>";  

                echo "<table class='table table-hover table-responsive table-bordered box'>";
                    echo "<tr>";
                        echo "<th>Job Card No</th>";
                        echo "<th>Client</th>";
                        echo "<th>Customer</th>";
                        echo "<th>Status</th>";
                        echo "<th>Created On</th>"; 
                        echo "<th>Deadline</th>";
                        echo "<th>Days Left</th>";
                        echo "<th>Quantity</th>";
                    echo "</tr>";

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        extract($row);

                        if ($row['deadline_enforce'] == 1) {
                            echo "<tr class='light-warning-bg'>";    
                        }
                        else {
                            echo "<tr>";
                        }

                        echo "<td>";
                            echo "<a href='{$home_url}job_card_process/read_one.php?id={$row['id']}'>";
                                echo "<div style='height:100%;width:100%''>";
                                    echo "{$row['id']}";
                                echo "</div>";
                            echo "</a>";
                        echo "</td>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['Client']}</td>";
                        echo "<td>{$row['Customer']}</td>";
                        echo "<td>{$row['Status']}</td>";
                        echo "<td>" . date("j F Y", strtotime($row['Created'])) ."</td>";
                        echo "<td>" . date("j F Y", strtotime($row['Deadline'])) ."</td>";
                        echo "<td>{$row['Days Left']}</td>";                            

                        $stmt_sub = $report->dashboardDeadlineReportCountQuantity($row['id']);
                        $total_rows_sub = $stmt_sub->rowCount();
                    
                        if ($total_rows_sub > 0 ){
                            
                            while ($row_sub = $stmt_sub->fetch(PDO::FETCH_ASSOC)){
                                        
                                extract($row_sub);       
                                echo "<td>{$row_sub['Count']}</td>";

                            }
                        }
                        echo "</tr>";
                    }
                echo "</table>";
                }

            ?>

        </div>

    </div>    

</div>


<?php

include_once 'layout_footer.php';
?>