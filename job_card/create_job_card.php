<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/status.php';
include_once '../objects/business.php';
include_once '../objects/invoice.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$job_card = new Job_Card($db);
$status = new Status($db);
$business = new Business($db);
$invoice = new Invoice($db);

// set navigation
$nav_title = "Job_Card";

// set page headers
$page_title = "Create Job_Card";
include_once "layout_header.php";

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Job_Cards</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set job_card property values
	$job_card->client_business_id = $_POST['client_business_id'];
	$job_card->customer_business_id = $_POST['customer_business_id'];
    $job_card->job_card_status_id = $_POST['job_card_status_id'];
    
    // set invoice property values
    $invoice->invoice_number = $_POST['invoice_number'];
	$invoice->job_card_id = $_POST['job_card_id'];
    $invoice->date_due = $_POST['date_due'];
	$invoice->total_invoiced = $_POST['total_invoiced'];
    $invoice->invoice_status_id = $_POST['invoice_status_id'];

    // create the job_card
    if($job_card->create()){

        // create the invoice
        if($invoice->create()){
            echo "<div class='alert alert-success'>Job_Card was created.</div>";
        }

        // if unable to create the invoice, tell the user
        else {
            echo "<div class='alert alert-danger'>Unable to create job_card.</div>";
            exit;
        }
        
    }

    // if unable to create the job_card, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create job_card.</div>";
    }
}
?>

<!-- HTML form for creating a job_card -->

<form name="job_card_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

	<!-- <tr>
		<td>Client Business ID</td>
		<td><input type='text' name='client_business_id' class='form-control'/></td>
	</tr> -->

    <tr>
        <td>Client Business</td>
        <td>
        
        <?php
        // read the product categories from the database
        $stmt = $business->read();
        
        // put them in a select drop-down
        echo "<select class='form-control' name='client_business_id'>";
            echo "<option>Select business...</option>";

            while ($row_business = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_business);
                echo "<option value='{$id}'>{$name}</option>";
            }

        echo "</select>";
        ?>

        </td>
    </tr>

    <tr>
        <td>Customer Business</td>
        <td>
        
        <?php
        // read the product categories from the database
        $stmt = $business->read();
        
        // put them in a select drop-down
        echo "<select class='form-control' name='customer_business_id'>";
            echo "<option>(optional) Select business...</option>";

            while ($row_business = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_business);
                echo "<option value='{$id}'>{$name}</option>";
            }

        echo "</select>";
        ?>

        </td>
    </tr>

    <tr>
        <td>Status</td>
        <td>
        
        <?php
        // read the product categories from the database
        $stmt = $status->readChildStatus('Job_Card', 'job_card_status_id', 'Sign In');
        
        // put them in a select drop-down
        echo "<select class='form-control' name='job_card_status_id'>";
            echo "<option>Select status...</option>";

            while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_status);
                echo "<option value='{$id}'>{$title}</option>";
            }

        echo "</select>";
        ?>

        </td>
    </tr>

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
		<td><input type='text' name='total_invoiced' value='0' class='form-control' /></td>
	</tr>

	<tr>
		<td>Invoice Status</td>
		<td>
		
		<?php
		// read the product categories from the database
		$stmt = $status->readParentStatus('Invoice', 'invoice_status_id');

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