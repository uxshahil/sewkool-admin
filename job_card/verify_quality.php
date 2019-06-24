<?php

// core.php holds pagination variables: includes session_start();
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php'; 

// inlcude database and object files
include_once $root_dir .'config/database.php';
include_once $root_dir .'objects/job_card.php';
include_once $root_dir .'objects/status.php';
include_once $root_dir .'objects/user.php';

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
$page_title = "Verify Quality";
include_once "layout_header.php";

$job_card_id = isset($_GET['id']) ? $_GET['id'] : "";

?>

<form name="update_job_card" method="post" action="manage_job_card_function.php?action=verify_quality">
    <table class='table table-hover table-responsive table-bordered box'>

        <tr>
            <td colspan="2" class="tableSubHeader" height="63px">Job Card</td>
        </tr>

        <tr>
			<td>Job Card  - Phase</td>
            <td>
                <input type="text" value="Production" id="job_card_phase" name="job_card_phase" class='form-control' readonly="readonly"/>
            </td>
        </tr>

        <tr>
			<td>Job Card  - Status</td>
            <td>
                <input type="text" value="Quality / Quantity Checked" class='form-control' readonly="readonly"/>
                <input type="hidden" value="14" id="job_card_status_id" name="job_card_status_id" class='form-control' readonly="readonly"/>
            </td>
        </tr>

        <tr>
            <td>Job Card</td>
            <td>
        
                <?php

                if ($job_card_id != "") {

                    $job_card->id = $job_card_id;
                    $job_card->readOne();
                    echo "<input type='text' value='{$job_card_id}' name='job_card_id' id='job_card_id' class='form-control' readonly='readonly'>";
                
                } else {

                    // read the product categories from the database
                    $stmt = $job_card->readVerifyQuality();
                    
                    // put them in a select drop-down
                    echo "<select id='job_card_id' class='form-control' name='job_card_id' onClick='submitForm()'>";
                        echo "<option>Select Job Card...</option>";

                        while ($row_business = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row_business);
                            echo "<option value='{$id}'>{$id}</option>";
                        }

                    echo "</select>";
                
                }
                ?>
            
            </td>
        </tr>

        <?php 

        if ($job_card_id != "") {

        echo "<tr id='tr_qty_quality_pass'>";
            echo "<td>Quality Verify - Pass</td>";
            echo "<td><input type='text' id='qty_quality_pass' name='qty_quality_pass' class='form-control' /></td>";
        echo "</tr>";

        echo "<tr id='tr_qty_quality_not_pass'>";
            echo "<td>Quality Verify - Not Pass</td>";
            echo "<td><input type='text' id='qty_quality_not_pass' name='qty_quality_not_pass' class='form-control' /></td>";
        echo "</tr>";

        echo "<tr id='tr_qty_quality_info'>";
            echo "<td>Quality Verify - Info</td>";
            echo "<td><input type='text' id='qty_quality_info' name='qty_quality_info' class='form-control' /></td>";
        echo "</tr>";

        echo "<tr>";
            echo "<td colspan='2' height='100px' class='submitButtonCol'>";
                echo "<button type='submit' class='btn btn-primary btn-block submitButton' onClick='submitForm()'>Verify</button>";
            echo "</td>";
        echo "</tr>";
        } 

        ?>
    </table>
</form>

<?php 
if ($job_card_id == "") {
    echo "<form name='update_job_card_quality' method='post'></form>";
}

// set page footer
include_once "layout_footer.php";
?>