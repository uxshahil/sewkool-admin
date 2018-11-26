<?php
// get ID of the business to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/business.php';
include_once '../objects/job_card.php';
include_once '../objects/invoice.php';
include_once '../objects/receipt.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$business = new Business($db);
$job_card = new Job_Card($db);
$invoice = new Invoice($db);
$receipt = new Receipt($db);

// set ID property of business to be read
$business->id = $id;

// read the details of business to be read
$business->readOne();

// set navigation
$nav_title = "Business";

// set page headers
$page_title = $business->name;
include_once "layout_header.php";

// read business button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Business ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a business details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td>Primary Key</td>";
		echo "<td>{$business->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Name</td>";
		echo "<td>{$business->name}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Description</td>";
		echo "<td>{$business->description}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Head Office</td>";
		echo "<td>{$business->head_office}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Branch Name</td>";
		echo "<td>{$business->branch_name}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address - Postal</td>";
		echo "<td>{$business->adr_postal}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address- Location</td>";
		echo "<td>{$business->adr_location}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Primary Contact: Name</td>";
		echo "<td>{$business->contact_primary_name}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Primary Contact: Number</td>";
		echo "<td>{$business->contact_primary_number}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Primary Contact: Email</td>";
		echo "<td>{$business->contact_primary_email}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Secondary Contact: Name</td>";
		echo "<td>{$business->contact_secondary_name}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Secondary Contact: Number</td>";
		echo "<td>{$business->contact_secondary_number}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Secondary Contact: Email</td>";
		echo "<td>{$business->contact_secondary_email}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Business: Number</td>";
		echo "<td>{$business->contact_business_number}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Business: Email</td>";
		echo "<td>{$business->contact_business_email}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Website</td>";
		echo "<td>{$business->contact_business_www}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Twitter</td>";
		echo "<td>{$business->contact_business_twitter}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Facebook</td>";
		echo "<td>{$business->contact_business_facebook}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Instagram</td>";
		echo "<td>{$business->contact_business_instagram}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>YouTube</td>";
		echo "<td>{$business->contact_business_youtube}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - Date</td>";
		echo "<td>{$business->created_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - By</td>";
		echo "<td>{$business->created_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - Date</td>";
		echo "<td>{$business->modified_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - By</td>";
		echo "<td>{$business->modified_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Row Source</td>";
		echo "<td>{$business->row_source}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Image</td>";
		echo "<td>";
			echo $business->image ? "<img src='uploads/{$business->image}' style='width:300px;' />" : "No image found.";
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Vat</td>";
		echo "<td>{$business->vat}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Company Registration</td>";
		echo "<td>{$business->company_registration}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Account Status ID</td>";
		echo "<td>{$business->account_status_id}</td>";
	echo "</tr>";

echo "</table>";

$job_card->readAllForBusiness($business->id);
$stmt = $job_card->readAllForBusiness($business->id);
$total_rows = $stmt->rowCount();

// create job_card button
echo "<div class='right-button-margin'>";
    echo "<a href='../job_card_process/create_job_card.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create job_card";
    echo "</a>";
echo "</div>";

// display the job_card if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered box'>";
        echo "<tr>";
			echo "<th>Job Card Number</th>";
			echo "<th>Client</th>";
			echo "<th>Status</th>";
			echo "<th></th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            echo "<tr>";
				echo "<td>{$id}</td>";
				echo "<td>{$name}</td>";
				echo "<td>{$title}</td>";

                echo "<td style='text-align: right;'>";
                    // read job_card button
                    echo "<a href='../job_card_process/read_one.php?id={$id}' class='btn btn-primary left-margin>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";

                    // edit job_card button
                    echo "<a href='../job_card_process/update_job_card.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
					echo "</a>";
	
					// print job_card button
					echo "<a href='../job_card_process/print_job_card.php?id={$id}' class='btn left-margin'>";
						echo "<span class='glyphicon glyphicon-print'></span> Print";
					echo "</a>";

                    // delete job_card button
                    /*echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'</span> Delete";
                    echo "</a>";*/
                echo "</td>";

            echo "</tr>";
        }
    echo "</table>";
}
 
// tell the user there are no Job_Cards
else{
    echo "<div class='alert alert-danger'>No Job_Cards found.</div>";
}

$invoice->readAllForBusiness($business->id);
$stmt = $invoice->readAllForBusiness($business->id);
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
				echo "<td>{$total_invoiced}</td>";
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
					echo "<a href='../invoice/print_invoice.php?id={$id}' class='btn left-margin'>";
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

$receipt->readAllForBusiness($business->id);
$stmt = $receipt->readAllForBusiness($business->id);
$total_rows = $stmt->rowCount();

// create receipt button
echo "<div class='right-button-margin'>";
    echo "<a href='../receipt/create_receipt.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create receipt";
    echo "</a>";
echo "</div>";

// display the receipt if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered box'>";
        echo "<tr>";
			echo "<th>Receipt Number</th>";
			echo "<th>Client</th>";
			echo "<th>Amount Receipted</th>";
            echo "<th>Payment Reference</th>";
            echo "<th></th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            echo "<tr>";
				echo "<td>{$id}</td>";
				echo "<td>{$name}</td>";
				echo "<td>{$amount_receipted}</td>";
				echo "<td>{$payment_reference}</td>";

                echo "<td style='text-align: right;'>";
                    // read receipt button
                    echo "<a href='../receipt/read_one.php?id={$id}' class='btn btn-primary left-margin>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";

                    // edit receipt button
                    echo "<a href='../receipt/update_receipt.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
					echo "</a>";
					
					// print receipt button
					echo "<a href='../receipt/print_receipt.php?id={$id}' class='btn left-margin'>";
						echo "<span class='glyphicon glyphicon-print'></span> Print";
					echo "</a>";

                    // delete receipt button
                    /*echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'</span> Delete";
                    echo "</a>";*/
                echo "</td>";

            echo "</tr>";
        }
    echo "</table>";
}
 
// tell the user there are no Receipts
else{
    echo "<div class='alert alert-danger'>No Receipts found.</div>";
}

$business->accountSummary();
$stmt = $business->accountSummary();
$total_rows = $stmt->rowCount();

// display the receipt if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered box'>";
        echo "<tr>";
			echo "<th>Client</th>";
			echo "<th>Amount</th>";
            echo "<th>Date</th>";
            echo "<th></th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            echo "<tr>";
				echo "<td>{$row['name']}</td>";
				echo "<td>{$row['amount']}</td>";
				echo "<td>{$row['date']}</td>";

                echo "<td style='text-align: right;'>";
                echo "</td>";

			echo "</tr>";
        }
	echo "</table>";
	

}
 
// tell the user there are no Receipts
else{
    echo "<div class='alert alert-danger'>No Receipts found.</div>";
}

// set footer
include_once "layout_footer.php";
?>