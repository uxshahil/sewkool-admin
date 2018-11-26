<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';
include_once '../objects/status.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$invoice = new Invoice($db);
$status = new Status($db);

// set navigation
$nav_title = "Invoice";

// set page headers
$page_title = "Create Invoice";
include_once "layout_header.php";

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Invoices</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set invoice property values
	$invoice->invoice_number = $_POST['invoice_number'];
	$invoice->job_card_id = $_POST['job_card_id'];
	$invoice->date_due = $_POST['date_due'];
	$invoice->total_invoiced = $_POST['total_invoiced'];
	$invoice->invoice_status_id = $_POST['invoice_status_id'];

    // create the invoice
    if($invoice->create()){
        echo "<div class='alert alert-success'>Invoice was created.</div>";
    }

    // if unable to create the invoice, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create invoice.</div>";
    }
}
?>

<!-- HTML form for creating a invoice -->

<form name="invoice_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

	<tr>
		<td>Invoice Number</td>
		<td><input type='text' name='invoice_number' class='form-control' /></td>
	</tr>

	<tr>
		<td>Job Card ID</td>
		<td><input type='text' name='job_card_id' class='form-control' /></td>
	</tr>

	<tr>
		<td>Date Due</td>
		<td><input type='date' name='date_due' class='form-control' /></td>
	</tr>

	<tr>
		<td>Total - Invoiced</td>
		<td><input type='text' name='total_invoiced' class='form-control' /></td>
	</tr>

	<tr>
		<td>Invoice Status</td>
		<td>
		
		<?php
		// read the product categories from the database
		$stmt = $status->read();

		// put them in a select drop-down
		echo "<select class='form-control' name='invoice_status_id'>";
			echo "<option value=''>Select payment status...</option>";

			while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row_status);
				echo "<option value='{$id}'>{$title}</option>";
			}

		echo "</select>";
		?>

		</td>
	</tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>

    </table>
</form>

<?php

// footer 
include_once "layout_footer.php";
?>