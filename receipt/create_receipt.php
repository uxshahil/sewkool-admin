<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/business.php';
include_once '../objects/receipt.php';
include_once '../objects/lookup.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$receipt = new Receipt($db);
$business = new Business($db);
$lookup = new Lookup($db);

// set navigation
$nav_title = "Receipt";

// set page headers
$page_title = "Create Receipt";
include_once "layout_header.php";

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Receipts</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set receipt property values
	$receipt->client_business_id = $_POST['client_business_id'];
	$receipt->date_receipted = $_POST['date_receipted'];
	$receipt->amount_receipted = $_POST['amount_receipted'];
	$receipt->payment_method_id = $_POST['payment_method_id'];
	$receipt->payment_reference = $_POST['payment_reference'];

    // create the receipt
    if($receipt->create()){

        // update account status
        $business->id = $receipt->client_business_id;
        $business->setAccountStatus();

        echo "<div class='alert alert-success'>Receipt was created.</div>";
    }

    // if unable to create the receipt, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create receipt.</div>";
    }
}
?>

<!-- HTML form for creating a receipt -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

    <tr>
        <td>Client Business</td>
        <td>
        
        <?php
        // read the product categories from the database
        $stmt = $business->read();
        
        // put them in a select drop-down
        echo "<select id='client_business_id' class='form-control' name='client_business_id'>";
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
		<td>Date Receipted</td>
		<td><input type='date' name='date_receipted' class='form-control' /></td>
	</tr>

	<tr>
		<td>Amount Receipted</td>
		<td><input type='text' name='amount_receipted' class='form-control' /></td>
	</tr>

	<tr>
		<td>Payment Method</td>
		<td>
        <?php
		// read the product categories from the database
        $stmt = $lookup->readCollection("payment_method");
        
        // put them in a select drop-down
        echo "<select id='payment_method_id' class='form-control' name='payment_method_id'>";
            echo "<option>Select payment method...</option>";

            while ($row_payment_method = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_payment_method);
                echo "<option value='{$id}'>{$title}</option>";
            }

        echo "</select>";
        ?>
		</td>
	</tr>

	<tr>
		<td>Payment Reference</td>
		<td><input type='text' name='payment_reference' class='form-control' /></td>
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