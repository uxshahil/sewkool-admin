<?php
// get ID of the Job Card to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/status.php';
include_once '../objects/business.php';
include_once '../objects/invoice.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$job_card = new Job_Card($db);
$status = new Status($db);
$business = new Business($db);
$invoice = new Invoice($db);

// set ID property of Job Card to be read
$job_card->id = $id;
$invoice->id = $id;

// read the details of Job Card to be read
$job_card->readOne();
$invoice->readOne();

// set navigation
$nav_title = "Job Card";

// set page headers
$page_title = "Read One Job Card";
include_once "layout_header.php";

// read Job Card button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Job Card ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a Job Card details
echo "<table class='table table-hover table-responsive table-bordered'>";

	echo "<tr>";
		echo "<td>Job Card Number</td>";
		echo "<td>{$job_card->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Client</td>";
		echo "<td>";
			// display business 
			$business->id=$job_card->client_business_id;
			$business->readName();
			echo $business->name;
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Customer</td>";
		echo "<td>";
		// display business 
			$business->id=$job_card->customer_business_id;
			$business->readName();
			echo $business->name;
		echo "</td>";
	echo "</tr>";

	echo "<tr>";    
		echo "<td>Job Card - Status</td>";
		echo "<td>";
			// display status 
			$status->id=$job_card->job_card_status_id;
			$status->readName();
			echo $status->title;
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Invoice Number</td>";
		echo "<td>{$invoice->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Date Issued</td>";
		echo "<td>{$invoice->date_issued}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Date Due</td>";
		echo "<td>{$invoice->date_due}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Total - Invoiced</td>";
		echo "<td>{$invoice->total_invoiced}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Signed Off - By</td>";
		echo "<td>{$invoice->signed_off_by}</td>";
	echo "</tr>";

	echo "<tr>";    
		echo "<td>Invoice - Status</td>";
		echo "<td>";
			// display status 
			$status->id=$invoice->invoice_status_id;
			$status->readName();
			echo $status->title;
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Client Invoiced Number</td>";
		echo "<td>{$job_card->client_invoice_number}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Skip Artwork Phase</td>";
		echo "<td>{$job_card->skip_artwork}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Quantity - Customer</td>";
		echo "<td>{$job_card->qty_verify_customer}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Quantity Verify - Checked</td>";
		echo "<td>{$job_card->qty_verify_checked}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Quantity Verify - Info</td>";
		echo "<td>{$job_card->qty_verify_info}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Quality Verify - Pass</td>";
		echo "<td>{$job_card->qty_quality_pass}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Quality Verify - Not Pass</td>";
		echo "<td>{$job_card->qty_quality_not_pass}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Quality Verify - Info</td>";
		echo "<td>{$job_card->qty_quality_info}</td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td>Quality Verify - Info</td>";
		echo "<td>{$job_card->assigned_to}</td>";
	echo "</tr>";	

echo "<table class='table table-hover table-responsive table-bordered'>";

	echo "<h1>Goods Received</h1>";

echo "</table>";

// set footer
include_once "layout_footer.php";
?>