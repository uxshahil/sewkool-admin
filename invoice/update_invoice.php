<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';
include_once '../objects/status.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$invoice = new Invoice($db);
$status = new Status($db);

// set ID property of invoice to be edited
$invoice->id = $id;

// read the details of invoice to be edited
$invoice->readOne();

// set navigation
$nav_title = "Invoice";

// set page header
$page_title = "Update Invoice";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read Invoice</a>";
    echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set invoice property values
    $invoice->date_issued = $_POST['date_issued'];
    $invoice->date_due = $_POST['date_due'];
	$invoice->total_invoiced = $_POST['total_invoiced'];
	$invoice->invoice_status_id = $_POST['invoice_status_id'];

// update the invoice
    if($invoice->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Invoice was updated.";
        echo "</div>";
    }

// if unable to update the invoice, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate invoice.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Invoice Number</td>
			<td><input type='text' name='invoice_number' value='<?php echo $invoice->invoice_number; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Job Card ID</td>
			<td><input type='text' name='job_card_id' value='<?php echo $invoice->job_card_id; ?>' class='form-control' /></td>
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
			<td>Invoice Status</td>
            <td>
                <?php
                $stmt = $status->read();

                // put them in a select drop-down
                echo "<select class='form-control' name='invoice_status_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $status_id = $row_status['id'];
                        $status_fk_field = $row_status['fk_field'];

                        // current status of the invoice must be selected
                        if($invoice->invoice_status_id==$status_id){
                            echo "<option value='$status_id' selected>";
                        } else {
                            echo "<option value='$status_id'>";
                        }

                        echo "$status_fk_field</option>";
                    }
                echo "</select>";
                ?>
            </td>
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