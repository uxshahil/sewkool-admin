<?php
// get ID of the invoice to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$invoice = new Invoice($db);

// set ID property of invoice to be read
$invoice->id = $id;

// read the details of invoice to be read
$invoice->readOne();

// set navigation
$nav_title = "Invoice";

// set page headers
$page_title = "Invoice - " .$invoice->invoice_number;
include_once "layout_header.php";

// read invoice button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Invoice ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a invoice details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td>Primary Key</td>";
		echo "<td>{$invoice->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Invoice Number</td>";
		echo "<td>{$invoice->invoice_number}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Job Card ID</td>";
		echo "<td>{$invoice->job_card_id}</td>";
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
		echo "<td>Invoice Status</td>";
		echo "<td>{$invoice->invoice_status_id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - Date</td>";
		echo "<td>{$invoice->created_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - By</td>";
		echo "<td>{$invoice->created_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - Date</td>";
		echo "<td>{$invoice->modified_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - By</td>";
		echo "<td>{$invoice->modified_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Row Source</td>";
		echo "<td>{$invoice->row_source}</td>";
	echo "</tr>";



echo "</table>";

// set footer
include_once "layout_footer.php";
?>