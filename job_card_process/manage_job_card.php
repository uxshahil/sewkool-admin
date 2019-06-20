<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/status.php';
include_once '../objects/user.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$job_card = new Job_Card($db);
$status = new Status($db);
$user = new User($db);

// set navigation
$nav_title = "Job Card";

// set page headers
$page_title = "Manage Job Card Status";
include_once "layout_header.php";
?>

<form name="update_job_card" method="post">
    <table class='table table-hover table-responsive table-bordered box'>
        
        <tr>
            <td colspan="2" class="tableSubHeader" height="63px">Job Card</td>
        </tr>

        <tr>
            <td>Job Card</td>
            <td>
        
                <?php
                // read the product categories from the database
                $stmt = $job_card->read();
                
                // put them in a select drop-down
                echo "<select id='job_card_id' class='form-control' name='job_card_id'>";
                    echo "<option>Select Job Card...</option>";

                    while ($row_business = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row_business);
                        echo "<option value='{$id}'>{$id}</option>";
                    }

                echo "</select>";
                ?>
            
            </td>
        </tr>

        <tr>
			<td>Job Card  - Phase</td>
            <td>
                <?php
                $stmt = $status->readParentStatus("job_card","job_card_status_id");

                // put them in a select drop-down
                echo "<select id='job_card_phase' class='form-control' name='job_card_phase' onClick='getJobCardStatus()'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $status_id = $row_status['id'];
                        $status_title = $row_status['title'];

                        echo "<option value='$status_id'>$status_title</option>";
                    }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
			<td>Job Card  - Status</td>
            <td><select id='job_card_status_id' class='form-control' name='job_card_status_id' onClick=' setStatusInputs()'></select></td>
        </tr>

        <tr id="tr_qty_verify_customer" style="display:none;">
            <td>Quantity - Customer</td>
            <td><input type='text' id='qty_verify_customer' name='qty_verify_customer' class='form-control' /></td>
        </tr>

        <tr id="tr_qty_verify_checked" style="display:none;">
            <td>Quantity Verify - Checked</td>
            <td><input type='text' id='qty_verify_checked' name='qty_verify_checked' class='form-control' /></td>
        </tr>

        <tr id="tr_qty_verify_info" style="display:none;">
            <td>Quantity Verify - Info</td>
            <td><input type='text' id='qty_verify_info' name='qty_verify_info' class='form-control' /></td>
        </tr>

        <tr id="tr_qty_quality_pass" style="display:none;">
            <td>Quality Verify - Pass</td>
            <td><input type='text' id='qty_quality_pass' name='qty_quality_pass' class='form-control' /></td>
        </tr>

        <tr id="tr_qty_quality_not_pass" style="display:none;">
            <td>Quality Verify - Not Pass</td>
            <td><input type='text' id='qty_quality_not_pass' name='qty_quality_not_pass' class='form-control' /></td>
        </tr>

        <tr id="tr_qty_quality_info" style="display:none;">
            <td>Quality Verify - Info</td>
            <td><input type='text' id='qty_quality_info' name='qty_quality_info' class='form-control' /></td>
        </tr>

        <tr id="tr_assigned_to" style="display:none;">
            <td>Assigned To</td>
            <td>
            
            <?php
            // read the product categories from the database
            $stmt = $user->read();
            
            // put them in a select drop-down
            echo "<select id='assigned_to' class='form-control' name='assigned_to'>";
                echo "<option>Select user...</option>";

                while ($row_user = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row_user);
                    echo "<option value='{$id}'>{$first_name} {$last_name}</option>";
                }

            echo "</select>";
            ?>
            
            </td>
        </tr>                                                   

        <tr>
            <td colspan="2" height="67px" class="submitButtonCol">
                <button type="submit" class="btn btn-primary btn-block submitButton" onClick="submitForm()">Update</button>
            </td>
        </tr>
        
    </table>
</form>

<?php
// set page footer
include_once "layout_footer.php";
?>