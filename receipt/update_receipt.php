<?php
// get ID of the product to be edited
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
$lookup = new Lookup($db);
$business = new Business($db);

// set ID property of receipt to be edited
$receipt->id = $id;

// read the details of receipt to be edited
$receipt->readOne();

// set navigation
$nav_title = "Receipt";

// set page header
$page_title = "Update Receipt";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read Receipt</a>";
    echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set receipt property values
	$receipt->client_business_id = $_POST['client_business_id'];
	$receipt->date_receipted = $_POST['date_receipted'];
	$receipt->amount_receipted = $_POST['amount_receipted'];
	$receipt->payment_method_id = $_POST['payment_method_id'];
	$receipt->payment_reference = $_POST['payment_reference'];

// update the receipt
    if($receipt->update()){

        // update account status
        $business->id = $receipt->client_business_id;
        $business->setAccountStatus();

        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Receipt was updated.";
        echo "</div>";
    }

// if unable to update the receipt, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate receipt.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Client Business</td>

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
                        if($receipt->client_business_id==$business_id){
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
			<td>Date Receipted</td>
			<td><input type='date' name='date_receipted' value='<?php echo date( 'Y-m-d', strtotime($receipt->date_receipted)); ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Amount Receipted</td>
			<td><input type='text' name='amount_receipted' value='<?php echo $receipt->amount_receipted; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Payment Method</td>

            <td>
                <?php
                $stmt = $lookup->readCollection("payment_method");

                // put them in a select drop-down
                echo "<select class='form-control' name='payment_method_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_payment_method = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $payment_method_id = $row_payment_method['id'];
                        $payment_method_title = $row_payment_method['title'];

                        // current status of the invoice must be selected
                        if($receipt->payment_method_id==$payment_method_id){
                            echo "<option value='$payment_method_id' selected>";
                        } else {
                            echo "<option value='$payment_method_id'>";
                        }

                        echo "$payment_method_title</option>";
                    }
                echo "</select>";
                ?>
            </td>

		</tr>

		<tr>
			<td>Payment Reference</td>
			<td><input type='text' name='payment_reference' value='<?php echo $receipt->payment_reference; ?>' class='form-control' /></td>
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