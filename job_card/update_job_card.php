<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/invoice.php';
include_once '../objects/status.php';
include_once '../objects/business.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$job_card = new Job_Card($db);
$invoice = new Invoice($db);
$status = new Status($db);
$business = new Business($db);

// set ID property of Job Card to be edited
$job_card->id = $id;
$invoice->id = $id;

// read the details of Job Card to be edited
$job_card->readOne();
$invoice->readOne();

// set navigation
$nav_title = "Job Card";

// set page header
$page_title = "Update Job Card";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read Job Card</a>";
    echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set Job Card property values
	$job_card->client_business_id = $_POST['client_business_id'];
	$job_card->customer_business_id = $_POST['customer_business_id'];
    $job_card->job_card_status_id = $_POST['job_card_status_id'];
    $job_card->client_invoice_number = $_POST['client_invoice_number'];
    $job_card->skip_artwork = $_POST['skip_artwork'];
    $job_card->qty_verify_customer = $_POST['qty_verify_customer'];
    
    $invoice->date_issued = $_POST['date_issued'];
    $invoice->date_due = $_POST['date_due'];
	$invoice->total_invoiced = $_POST['total_invoiced'];
	$invoice->invoice_status_id = $_POST['invoice_status_id'];

// update the Job Card
    if($job_card->update()){
        if($invoice->update()){
            echo "<div class='alert alert-success alert-dismissable'>";
                echo "Job Card was updated.";
            echo "</div>";
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to udpate Job Card.";
            echo "</div>";
        }
    }

// if unable to update the Job Card, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate Job Card.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

        <tr>
			<td>Client</td>
            <td>
                <?php
                $stmt = $business->read();

                // put them in a select drop-down
                echo "<select class='form-control' name='client_business_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_business = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $business_id = $row_business['id'];
                        $business_name = $row_business['name'];

                        // current status of the invoice must be selected
                        if($job_card->client_business_id==$business_id){
                            echo "<option value='$business_id' selected>";
                        } else {
                            echo "<option value='$business_id'>";
                        }

                        echo "$business_name</option>";
                    }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
			<td>Customer</td>
            <td>
                <?php
                $stmt = $business->read();

                // put them in a select drop-down
                echo "<select class='form-control' name='customer_business_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_business = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $business_id = $row_business['id'];
                        $business_name = $row_business['name'];

                        // current status of the invoice must be selected
                        if($job_card->customer_business_id==$business_id){
                            echo "<option value='$business_id' selected>";
                        } else {
                            echo "<option value='$business_id'>";
                        }

                        echo "$business_name</option>";
                    }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
			<td>Job Card  - Status</td>
            <td>
                <?php
                $stmt = $status->read();

                // put them in a select drop-down
                echo "<select class='form-control' name='job_card_status_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $status_id = $row_status['id'];
                        $status_title = $row_status['title'];

                        // current status of the invoice must be selected
                        if($job_card->job_card_status_id==$status_id){
                            echo "<option value='$status_id' selected>";
                        } else {
                            echo "<option value='$status_id'>";
                        }

                        echo "$status_title</option>";
                    }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
			<td>Date Issued</td>
			<td><input type='date' name='date_issued' value='<?php echo $invoice->date_issued; ?>' class='form-control' /></td>
		</tr>

        <tr>
			<td>Date Due</td>
			<td><input type='date' name='date_due' value='<?php echo $invoice->date_due; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Total - Invoiced</td>
			<td><input type='text' name='total_invoiced' value='<?php echo $invoice->total_invoiced; ?>' class='form-control' /></td>
        </tr>
        
		<tr>
			<td>Invoice - Status</td>
            <td>
                <?php
                $stmt = $status->readParentStatus('Invoice', 'invoice_status_id');

                // put them in a select drop-down
                echo "<select class='form-control' name='invoice_status_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $status_id = $row_status['id'];
                        $status_title = $row_status['title'];

                        // current status of the invoice must be selected
                        if($invoice->invoice_status_id==$status_id){
                            echo "<option value='$status_id' selected>";
                        } else {
                            echo "<option value='$status_id'>";
                        }

                        echo "$status_title</option>";
                    }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
			<td>Client Order Number</td>
			<td><input type='text' name='client_invoice_number' value='<?php echo $job_card->client_invoice_number; ?>' class='form-control' /></td>
        </tr>

        <tr>
			<td>Skip Artwork Phase</td>
            <td>
				<select class='form-control' name='skip_artwork'>
					<?php 
						if ($job_card->skip_artwork == 0){
							echo "<option value='0' selected>No</option>";
							echo "<option value='1'>Yes</option>";
						} elseif ($job_card->skip_artwork == 1) {
							echo "<option value='0'>No</option>";
							echo "<option value='1' selected>Yes</option>";
						}
					?>
				</select>
			</td>
        </tr>

        <tr>
			<td>Quantity - Customer</td>
			<td><input type='text' name='qty_verify_customer' value='<?php echo $job_card->qty_verify_customer; ?>' class='form-control'/></td>
		</tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
    </table>
</form>

<?php

// set page footer
include_once "layout_footer.php";
?>