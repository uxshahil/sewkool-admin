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
include_once '../objects/line_item.php';
include_once '../objects/status_history.php';
include_once '../objects/user.php';
include_once '../objects/lookup.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$job_card = new Job_Card($db);
$status = new Status($db);
$business = new Business($db);
$invoice = new Invoice($db);
$line_item = new Line_Item($db);
$status_history = new Status_History($db);
$user = new User($db);
$lookup = new Lookup($db);

// set ID property of Job Card to be read
$job_card->id = $id;
$invoice->job_card_id = $id;
$line_item->job_card_id = $id;

// read the details of Job Card to be read
$job_card->readOne();
$invoice->readJobCardItems();

// read the details of the Job Card line_items
$stmt = $line_item->readJobCardItems();

// set navigation
$nav_title = "Job Card";

// set page headers
$page_title = "Job Card - " .$job_card->id;
include_once "layout_header.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";

if($action=='status_updated'){
    echo "<div class='col-md-12'>";
		echo "<div class='alert alert-success alert-dismissable'>";
			echo "Job Card Status was updated.";
		echo "</div>";
    echo "</div>";
}

else if($action=='verify_quantity'){
    echo "<div class='col-md-12'>";
		echo "<div class='alert alert-success alert-dismissable'>";
			echo "Quantity checks updated.";
		echo "</div>";
    echo "</div>";
}

else if($action=='verify_quality'){
    echo "<div class='col-md-12'>";
		echo "<div class='alert alert-success alert-dismissable'>";
			echo "Quality checks updated.";
		echo "</div>";
    echo "</div>";
}

else if($action=='assign_user'){
    echo "<div class='col-md-12'>";
		echo "<div class='alert alert-success alert-dismissable'>";
			echo "User assigned to Job Card.";
		echo "</div>";
    echo "</div>";
}

// read Job Card button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Job Card ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a Job Card details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td>Job Card Number</td>";
		echo '<td><svg id="barcode"><script>JsBarcode("#barcode", "'.$job_card->id.'");</script></svg></td>';
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
		echo "<td id='total_invoiced'>R{$invoice->total_invoiced}</td>";
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
		echo "<td>Client Order Number</td>";
		echo "<td>{$job_card->client_invoice_number}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Skip Artwork Phase</td>";
		if ($job_card->skip_artwork == 0){
			echo "<td>No</td>";
		} elseif ($job_card->skip_artwork == 1) {
			echo "<td>Yes</td>";
		}
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
		echo "<td>Assigned To</td>";
		echo "<td>";
			$user->id=$job_card->assigned_to;
			$user->readName();
			echo $user->name;
		echo "</td>";
    echo "</tr>";
    
    echo "<tr>";
        echo "<td>Job Type</td>";

        echo "<td>";
            // display Job Type 
            $lookup->id=$job_card->job_type_id;
            $lookup->readName();
            echo $lookup->title;
        echo "</td>";

    echo "</tr>";

    echo "<tr>";
        echo "<td>Deadline Date</td>";
        echo "<td>{$job_card->deadline_date}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Enforce Deadline</td>";
        if ($job_card->deadline_enforce == 0){
			echo "<td>No</td>";
		} elseif ($job_card->deadline_enforce == 1) {
			echo "<td>Yes</td>";
		}
    echo "</tr>";

    echo "<tr>";
        echo "<td>Priority</td>";

        echo "<td>";
            // display Priority 
            $lookup->id=$job_card->priority_id;
            $lookup->readName();
            echo $lookup->title;
        echo "</td>";

    echo "</tr>";
    
echo "</table>";

	// check database for existing temporary line items
	$total = $line_item->countAll();

	if($total>0){
		$item_count = 1;

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			echo "<h2>Goods Received - {$item_count}</h2>";

			echo "<table class='table table-hover table-responsive table-bordered box'>";

				echo "<tr>";
					echo "<td>Item</td>";
					echo "<td><input type='text' name='item_{$item_count}' value='{$item}' class='form-control' />";
					echo "</td>";
				echo "</tr>";
		
				echo "<tr>";
					echo "<td>Item - Quantity</td>";
					echo "<td><input type='text' name='item_qty_{$item_count}' value='{$item_qty}' class='form-control' /></td>";
				echo "</tr>";
		
				echo "<td>Artwork - Logo</td>";
				echo "<td>";
					echo $artwork_logo ? "<img src='../images/{$artwork_logo}' style='width:300px;' />" : "No image found.";
				echo "</td>";
		
				echo "<tr>";
					echo "<td>Artwork - Position</td>";
					echo "<td><input type='text' name='artwork_position_{$item_count}' value='{$artwork_position}' class='form-control' /></td>";
				echo "</tr>";
		
				echo "<tr>";
					echo "<td>Artwork - Color</td>";
					echo "<td><input type='text' name='artwork_color_{$item_count}' value='{$artwork_color}' class='form-control' /></td>";
				echo "</tr>";
		
				echo "<tr>";
					echo "<td>Other Info</td>";
					echo "<td><input type='text' name='other_info_{$item_count}' value='{$other_info}' class='form-control' /></td>";
				echo "</tr>";
		
				echo "<tr>";
					echo "<td>Price - Artwork</td>";
					echo "<td>R<input type='text' name='price_artwork_{$item_count}' value='{$price_artwork}' class='form-control' /></td>";
				echo "</tr>";
		
				echo "<tr>";
					echo "<td>Price - Setup</td>";
					echo "<td>R<input type='text' name='price_setup_{$item_count}' value='{$price_setup}' class='form-control' /></td>";
				echo "</tr>";

				echo "<tr>";
					echo "<td>Price - Embroidery</td>";
					echo "<td>R<input type='text' name='price_setup_{$item_count}' value='{$price_embroidery}' class='form-control' /></td>";
				echo "</tr>";
		
			echo "</table>";
			$item_count += 1;
		}
	}   

	$invoice->readAllForJobCard($job_card->id);
	$stmt = $invoice->readAllForJobCard($job_card->id);
	$total_rows = $stmt->rowCount();

	// display the invoice if there are any
	if($total_rows>0){
	
		echo "<table class='table table-hover table-responsive table-bordered box'>";
			echo "<tr>";
				echo "<th>Invoice Number</th>";
				echo "<th>Client</th>";
				echo "<th>Total Invoiced</th>";
				echo "<th>Status</th>";
				echo "<th></th>";
			echo "</tr>";

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				
				extract($row);

				echo "<tr>";
					echo "<td>{$invoice_number}</td>";
					echo "<td>{$name}</td>";
					echo "<td>R{$total_invoiced}</td>";
					echo "<td>{$title}</td>";

					echo "<td style='text-align: right;'>";
						// read invoice button
						echo "<a href='../invoice/read_one.php?id={$invoice_id}' class='btn btn-primary left-margin>";
							echo "<span class='glyphicon glyphicon-list'></span> Read";
						echo "</a>";

						// edit invoice button
						echo "<a href='../invoice/update_invoice.php?id={$invoice_id}' class='btn btn-info left-margin'>";
							echo "<span class='glyphicon glyphicon-edit'></span> Edit";
						echo "</a>";
						
						// print invoice button
						echo "<a href='../invoice/print_invoice.php?id={$invoice_number}' class='btn left-margin'>";
							echo "<span class='glyphicon glyphicon-print'></span> Print";
						echo "</a>";

						// delete invoice button
						/*echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
							echo "<span class='glyphicon glyphicon-remove'</span> Delete";
						echo "</a>";*/
					echo "</td>";

				echo "</tr>";
			}
		echo "</table>";
	}
	
	// tell the user there are no Invoices
	else{
		echo "<div class='alert alert-danger'>No Invoices found.</div>";
	}

	$business->readOneForJobCard($job_card->id);
	$stmt = $business->readOneForJobCard($job_card->id);
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
	}
	
	// tell the user there are no Businesses
	else{
		echo "<div class='alert alert-danger'>No Businesses found.</div>";
	}

	$status_history->readOneForJobCard($job_card->id);
	$stmt = $status_history->readOneForJobCard($job_card->id);
	$total_rows = $stmt->rowCount();

	// display the business if there are any
	if($total_rows>0){
	
		echo "<table class='table table-hover table-responsive table-bordered box'>";
			echo "<tr>";
				echo "<th>Status</th>";
				echo "<th>Name</th>";
				echo "<th>Date</th>";
				echo "<th></th>";
			echo "</tr>";

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				
				extract($row);

				echo "<tr>";
					echo "<td>{$title}</td>";
					echo "<td>{$name}</td>";
					echo "<td>{$created_date}</td>";

					echo "<td style='text-align: right;'>";
					echo "</td>";

				echo "</tr>";
			}
		echo "</table>";
	}
	
	// tell the user there are no Businesses
	else{
		echo "<div class='alert alert-danger'>No Businesses found.</div>";
	}

// set footer
include_once "layout_footer.php";
?>