<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/invoice.php';
include_once '../objects/status.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$job_card = new Job_Card($db);
$invoice = new Invoice($db);
$status = new Status($db);

// set navigation
$nav_title = "Invoice";

// set page headers
$page_title = "Sign Off Invoice";

include_once "layout_header.php";
?>

<form name="sign_off_invoice" action="sign_off_invoice_function.php?action=sign_off_invoice" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

        <tr>
            <td colspan="2" class="tableSubHeader" height="63px">Invoice</td>
        </tr>

        <tr>
            <td>Invoice *</td>
            <td>
        
                <?php
                // read the product categories from the database
                $stmt = $invoice->readPendingSignOff();
                
                // put them in a select drop-down
                echo "<select id='invoice_id' class='form-control' name='invoice_id'>";
                    echo "<option>Select Invoice...</option>";

                    while ($row_invoice = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row_invoice);
                        echo "<option value='{$id}'>{$invoice_number}</option>";
                    }

                echo "</select>";
                ?>
            
            </td>
        </tr>

        <tr>
			<td>Date *</td>
			<td><input type='date' name='date_issued'  class='form-control' /></td>
		</tr>

        <tr>
			<td>Signed Off - By *</td>
			<td>
                <input type='text' name='signed_off_by_name' <?php echo "value='{$_SESSION['first_name']}'" ?> readonly='readonly' class='form-control' />
                <input type='hidden' name='signed_off_by' <?php echo "value='{$_SESSION['user_id']}'" ?> readonly='readonly' class='form-control' />
            </td>
		</tr>

        <tr>
            <td colspan="2" height="67px" class="submitButtonCol">
                <button type="submit" class="btn btn-primary btn-block submitButton">Sign Off</button>
            </td>
        </tr>

    </table>
</form>

<?php
// set page footer
include_once "layout_footer.php";
?>