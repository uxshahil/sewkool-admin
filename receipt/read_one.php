<?php
// get ID of the receipt to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/receipt.php';
include_once '../objects/invoice.php';
include_once '../objects/lookup.php';
include_once '../objects/business.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$receipt = new Receipt($db);
$invoice = new Invoice($db);
$business = new Business($db);
$lookup = new Lookup($db);

// set ID property of receipt to be read
$receipt->id = $id;

// read the details of receipt to be read
$receipt->readOne();

// set navigation
$nav_title = "Receipt";

// set page headers
$page_title = "Receipt - " .$receipt->id;
include_once "layout_header.php";

// read receipt button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Receipt ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a receipt details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td>Receipt Number</td>";
		echo "<td>{$receipt->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Client Business</td>";
		echo "<td>";
			// display business 
			$business->id=$receipt->client_business_id;
			$business->readName();
			echo $business->name;
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Date Received</td>";
		echo "<td>{$receipt->date_receipted}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Total Amount</td>";
		echo "<td>{$receipt->amount_receipted}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Payment Method</td>";
		echo "<td>";
			// display business 
			$lookup->id=$receipt->payment_method_id;
			$lookup->readName();
			echo $lookup->title;
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Payment Reference</td>";
		echo "<td>{$receipt->payment_reference}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - Date</td>";
		echo "<td>{$receipt->created_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - By</td>";
		echo "<td>{$receipt->created_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - Date</td>";
		echo "<td>{$receipt->modified_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - By</td>";
		echo "<td>{$receipt->modified_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Row Source</td>";
		echo "<td>{$receipt->row_source}</td>";
	echo "</tr>";

echo "</table>";

$business->readOneForReceipt($receipt->id);
$stmt = $business->readOneForReceipt($receipt->id);
$total_rows = $stmt->rowCount();

// display the business if there are any
if($total_rows>0){

	echo "<table class='table table-hover table-responsive table-bordered box'>";
		echo "<tr>";
			echo "<th>Client ID</th>";
			echo "<th>Name</th>";
			echo "<th>Description</th>";
			echo "<th>Account Status</th>";
			echo "<th></th>";
		echo "</tr>";

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			
			extract($row);

			echo "<tr>";
				echo "<td>{$id}</td>";
				echo "<td>{$name}</td>";
				echo "<td>{$description}</td>";
				echo "<td>{$title}</td>";

				echo "<td style='text-align: right;'>";
					// read business button
					echo "<a href='../business/read_one.php?id={$id}' class='btn btn-primary left-margin>";
						echo "<span class='glyphicon glyphicon-list'></span> Read";
					echo "</a>";

					// edit business button
					echo "<a href='../business/update_business.php?id={$id}' class='btn btn-info left-margin'>";
						echo "<span class='glyphicon glyphicon-edit'></span> Edit";
					echo "</a>";

					// delete business button
					/*echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
						echo "<span class='glyphicon glyphicon-remove'</span> Delete";
					echo "</a>";*/
				echo "</td>";

			echo "</tr>";
		}
	echo "</table>";

	// paging buttons here
	include_once 'paging.php';
}

// tell the user there are no Businesses
else{
	echo "<div class='alert alert-danger'>No Businesses found.</div>";
}

// set footer
include_once "layout_footer.php";
?>