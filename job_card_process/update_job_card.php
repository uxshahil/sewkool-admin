<?php
// get ID of the product to be edited
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
$line_item= new Line_Item($db);
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

    $job_card->job_type_id = $_POST['job_type_id'];
    $job_card->deadline_date = $_POST['deadline_date'];
    $job_card->deadline_enforce = $_POST['deadline_enforce'];
	$job_card->priority_id = $_POST['priority_id'];

    $invoice->date_issued = $_POST['date_issued'];
    $invoice->date_due = $_POST['date_due'];
	$invoice->total_invoiced = $_POST['total_invoiced'];
	$invoice->invoice_status_id = $_POST['invoice_status_id'];

// update the Job Card
    if($job_card->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Job Card was updated.";
        echo "</div>";
    } else {
        // if unable to update the Job Card, tell the user
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update Job Card.";
        echo "</div>";
    }

    if($invoice->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Invoice was updated.";
        echo "</div>";
    } else {
        // if unable to update the Job Card, tell the user
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update Invoice.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>
        
        <tr>
            <td colspan="2" class="tableSubHeader" height="63px">Job Card</td>
        </tr>

        <tr>
			<td>Client Business *</td>
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
			<td>Customer Business</td>
            <td>
                <?php
                $stmt = $business->read();

                // put them in a select drop-down
                echo "<select class='form-control' name='customer_business_id'>";
                
                    echo "<option value='0'>Please select...</option>";
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
			<td>Quantity - Customer *</td>
			<td><input type='text' name='qty_verify_customer' value='<?php echo $job_card->qty_verify_customer; ?>' class='form-control'/></td>
		</tr>

        <tr>
            <td>Skip Artwork Phase *</td>
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
            <td>Job Type</td>

            <td>
                <?php
                $stmt = $lookup->readCollection("sew_job_type");

                // put them in a select drop-down
                echo "<select class='form-control' name='job_type_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_job_type = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $job_type_id = $row_job_type['id'];
                        $job_type_title = $row_job_type['title'];

                        // current status of the invoice must be selected
                        if($job_card->job_type_id==$job_type_id){
                            echo "<option value='$job_type_id' selected>";
                        } else {
                            echo "<option value='$job_type_id'>";
                        }

                        echo "$job_type_title</option>";
                    }
                echo "</select>";
                ?>
            </td>

        </tr>

        <tr>
            <td>Enforce Deadline</td>
            <td>
				<select class='form-control' name='deadline_enforce'>
					<?php 
						if ($job_card->deadline_enforce == 0){
							echo "<option value='0' selected>No</option>";
							echo "<option value='1'>Yes</option>";
						} elseif ($job_card->deadline_enforce == 1) {
							echo "<option value='0'>No</option>";
							echo "<option value='1' selected>Yes</option>";
						}
					?>
				</select>
			</td>
        </tr>

        <tr>
            <td>Deadline Date</td>
			<td><input type='date' name='deadline_date' value='<?php echo date( 'Y-m-d', strtotime($job_card->deadline_date)); ?>' class='form-control' /></td>
		</tr>

        <tr>
            <td>Priority</td>

            <td>
                <?php

                    $stmt = $lookup->readCollection("priority");
                    
                    while ($row_priority = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row_priority);

                        // current status of the invoice must be selected
                        if($id == $job_card->priority_id ){
                            echo "<input type='radio' name='priority_id' value='$id' checked/> $title ";
                        } else {
                            echo "<input type='radio' name='priority_id' value='$id' /> $title ";
                        }
                        
                    }

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
            <td colspan="2" class="tableSubHeader" height="63px">Invoice</td>
        </tr>

        <tr>
			<td>Invoice: Date Issued</td>
			<td><input type='date' name='date_issued' value='<?php echo date( 'Y-m-d', strtotime($invoice->date_issued)); ?>' class='form-control' /></td>
		</tr>

        <tr>
			<td>Invoice: Date Due *</td>
			<td><input type='date' name='date_due' value='<?php echo date( 'Y-m-d', strtotime($invoice->date_due)); ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Total - Invoiced *</td>
			<td><input type='text' name='total_invoiced' value='<?php echo $invoice->total_invoiced; ?>' class='form-control' <?php echo (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "") ?>/></td>
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
            <td colspan="2" class="tableSubHeader" height="63px">Client Reference</td>
        </tr>

        <tr>
			<td>Client Order Number</td>
			<td><input type='text' name='client_invoice_number' value='<?php echo $job_card->client_invoice_number; ?>' class='form-control'/></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
    </table>

    <?php

// check database for existing temporary line items
$total = $line_item->countAll();
// read the details of the Job Card line_items
$stmt = $line_item->readJobCardItems();

if($total>0){
    $item_count = 1;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
        echo "<h2>Goods Received - {$item_count}</h2>";

        echo "<table class='table table-hover table-responsive table-bordered box'>";

            echo "<tr>";
                echo "<td colspan='2' class='tableSubHeader' height='63px'>Item</td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>Item</td>";
                echo "<td><input type='text' name='item_{$item_count}' value='{$item}' class='form-control' />";
                echo "</td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td>Item - Quantity</td>";
                echo "<td><input type='text' name='item_qty_{$item_count}' value='{$item_qty}' class='form-control' /></td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td colspan='2' class='tableSubHeader' height='63px'>Artwork</td>";
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
                echo "<td colspan='2' class='tableSubHeader' height='63px'>Price</td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td>Price - Artwork</td>";
                echo "<td><input type='text' name='price_artwork_{$item_count}' value='{$price_artwork}' class='form-control'" . (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "readonly='readonly'"). "/></td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td>Price - Setup</td>";
                echo "<td><input type='text' name='price_setup_{$item_count}' value='{$price_setup}' class='form-control'" . (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "readonly='readonly'"). "/></td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>Price - Embroidery</td>";
                echo "<td><input type='text' name='price_setup_{$item_count}' value='{$price_embroidery}' class='form-control'" . (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "readonly='readonly'"). "/></td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td colspan='2' class='submitButtonCol'>";
                    // edit line_item button
                    echo "<a href='../line_item/update_line_item.php?id={$id}' class='btn btn-info left-margin btn-block'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
                echo "</td>";
            echo "</td>";
    
        echo "</table>";
        $item_count += 1;
    }
}   
?>
</form>

<?php
// set page footer
include_once "layout_footer.php";
?>