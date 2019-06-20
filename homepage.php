<?php

// core.php holds pagination variables
include_once "config/core.php";

// include database and object files
include_once 'config/database.php';
include_once 'objects/job_card.php';
include_once 'objects/status.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$job_card = new Job_Card($db);
$status = new Status($db);

// set navigation
$nav_title = "Home";

// set page header
$page_title = "Home";
include_once "layout_head.php";

// specify the page where paging is used
$page_url = "index.php?";

?>

<form name="filter_job_card" role='filter' action='filter.php' method="post">

    <div class="row right-button-margin">
        
        <div class="col-md-3">

            <?php
                $stmt = $status->readParentStatus("job_card","job_card_status_id");

                // put them in a select drop-down
                echo "<select id='job_card_phase' class='form-control' name='job_card_phase' onClick='filterPhase()'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $status_id = $row_status['id'];
                        $status_title = $row_status['title'];

                        echo "<option value='$status_id'>$status_title</option>";
                    }
                echo "</select>";
            ?>

        </div>

        <div class="col-md-3">
            <select id='job_card_status_id' class='form-control' name='job_card_status_id' onClick='setStatusInputs()'></select>
        </div>

        <div class='col-md-3 pull-right'>
            <a href='create_job_card.php' class='btn btn-primary pull-right'>
                <span class='glyphicon glyphicon-plus'></span> Create Job Card
            </a>
        </div>

    </div>
</form>

<?php

$action = isset($_GET['action']) ? $_GET['action'] : "";

if($action=='filter_phase'){
    $job_card_phase_id = isset($_GET['id']) ? $_GET['id'] : "";
    // query Job Card
    $stmt = $job_card->readAllPhase($from_record_num, $records_per_page, $job_card_phase_id);

}

else if($action=='filter_status'){

    // query Job Card
    $stmt = $job_card->readAll($from_record_num, $records_per_page);

} else {

    // query Job Card
    $stmt = $job_card->readAll($from_record_num, $records_per_page);

}

// count total rows - used for pagination
$total_rows=$job_card->countAll();
 
// display the Job Card if there are any
if($total_rows>0){

    echo "<div class='row'>";
    echo "<div class='col-md-12'>";
 
    echo "<table class='table table-hover table-responsive table-bordered box'>";
        echo "<tr>";
			echo "<th>Job Card Number</th>";
			echo "<th>Client</th>";
			echo "<th>Status</th>";
			echo "<th></th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            echo "<tr>";
				echo "<td>{$id}</td>";
				echo "<td>{$name}</td>";
				echo "<td>{$title}</td>";

                echo "<td style='text-align: right;'>";
                    // read Job Card button
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";

                    // edit Job Card button
                    echo "<a href='update_job_card.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";

                    // print Job Card button
                    echo "<a href='print_job_card.php?id={$id}' class='btn left-margin'>";
                        echo "<span class='glyphicon glyphicon-print'></span> Print";
                    echo "</a>";

                    // delete Job Card button
                    /*echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'</span> Delete";
                    echo "</a>";*/
                echo "</td>";

            echo "</tr>";
        }
    echo "</table>";

    // paging buttons here
    include_once 'paging.php';

    echo "</div>";
    echo "</div>";
}
 
// tell the user there are no Job_Cards
else{
    echo "<div class='alert alert-danger'>No Job_Cards found.</div>";
}

// layout_footer.php holds our javascript and closing html tags
include_once "layout_foot.php";
?>