<?php
// get ID of the job_card to be read
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

// set ID property of job_card to be read
$job_card->id = $id;
$invoice->id = $id;

// read the details of job_card to be read
$job_card->readOne();
$invoice->readOne();

// set navigation
$nav_title = "Job_Card";

// set page headers
$page_title = "Read One Job_Card";
include_once "layout_header.php";

// read job_card button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Job_Card ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a job_card details
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
		echo "<td>Invoice - Status</td>";
		echo "<td>";
			// display status 
			$status->id=$invoice->invoice_status_id;
			$status->readName();
			echo $status->title;
		echo "</td>";
	echo "</tr>";

echo "<table class='table table-hover table-responsive table-bordered'>";

	echo "<h1>Goods Received</h1>";

echo "</table>";

// set footer
include_once "layout_footer.php";
?>