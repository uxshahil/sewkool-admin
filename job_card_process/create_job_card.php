<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/status.php';
include_once '../objects/business.php';
include_once '../objects/invoice.php';
include_once '../objects/line_item_temp.php';
include_once '../objects/lookup.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$job_card = new Job_Card($db);
$status = new Status($db);
$business = new Business($db);
$invoice = new Invoice($db);
$line_item_temp = new Line_Item_Temp($db);
$lookup = new Lookup($db);

// set navigation
$nav_title = "Job Card";

// set page headers
$page_title = "Create Job Card";
include_once "layout_header.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";

if($action=='removed'){
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-info'>";
            echo "Line Item was removed from your Job Card!";
        echo "</div>";
    echo "</div>";
}

else if($action=='line_item_added'){
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-info'>";
            echo "Line Item was added to your Job Card!";
        echo "</div>";
    echo "</div>";

    //echo ' <script type="text/javascript"> calculateInvoiceTotal(); </script> ';
}

else if($action=='error'){
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>";
            echo "Line Item did not add!";
        echo "</div>";
    echo "</div>";
}

else if($action=='job_card_added'){
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-info'>";
            echo "Job Card added!";
        echo "</div>";
    echo "</div>";

    echo '<script type="text/javascript"> deleteAllCookies(); </script>';
}

else if($action=='job_card_error'){
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-info'>";
            echo "Job Card added!";
        echo "</div>";
    echo "</div>";

    echo '<script type="text/javascript"> deleteAllCookies(); </script>';
}

else if($action=='business_added'){
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-info'>";
            echo "Business added!";
        echo "</div>";
    echo "</div>";
}

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Job_Cards</a>";
echo "</div>";
?>

<!-- HTML form for creating a Job Card -->

<form name="create_job_card" action="create_job_card_w_line_items.php" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

    <tr>
		<td colspan="2" class="tableSubHeader" height="63px">Job Card</td>
	</tr>

    <tr>
        <td>Client Business *<span class="glyphicon glyphicon-plus primary-color m-l-10px" onclick="addCustomer();"></span></td>
        <td>
        
        <?php
        // read the product categories from the database
        $stmt = $business->read();
        
        // put them in a select drop-down
        echo "<select id='client_business_id' class='form-control' name='client_business_id' required>";
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
        <td>Customer Business<span class="glyphicon glyphicon-plus primary-color m-l-10px" onclick="addCustomer();"></span></td>
        <td>
        
        <?php
        // read the product categories from the database
        $stmt = $business->read();
        
        // put them in a select drop-down
        echo "<select id='customer_business_id' class='form-control' name='customer_business_id'>";
            echo "<option value='0'>(optional) Select business...</option>";

            while ($row_business = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_business);
                echo "<option value='{$id}'>{$name}</option>";
            }

        echo "</select>";
        ?>

        </td>
    </tr>

    <tr>
		<td>Quantity - Customer *</td>
		<td><input type='text' id='qty_verify_customer' name='qty_verify_customer' class='form-control' required/></td>
    </tr>

    <tr>
        <td>Job Type *</td>
		<td>
            <?php
            // read the product categories from the database
            $stmt = $lookup->readCollection("sew_job_type");

            // put them in a select drop-down
            echo "<select id='job_type_id' class='form-control' name='job_type_id'>";

                while ($row_job_type = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row_job_type);

                    // current status of the invoice must be selected
                    if($title == "Embroidery"){
                        echo "<option value='$id' selected/> $title ";
                    } else {
                        echo "<option value='$id' /> $title ";
                    }

                }

            echo "</select>";
            ?>
		</td>
	</tr>

    <tr>
		<td>Enforce Deadline *</td>
        <td>
            <select class='form-control' id='deadline_enforce' name='deadline_enforce' required>
                <option value='0' selected>No</option>
                <option value='1'>Yes</option>
            </select>
        </td>
	</tr>

	<tr>
		<td>Deadline Date *</td>
        <td><input type='date' id='deadline_date' name='deadline_date' class='form-control' required/></td>
	</tr>

    <tr>
        <td>Priority *</td>
		<td>
            <?php
            
                // read the product categories from the database
                $stmt = $lookup->readCollection("priority");

                while ($row_priority = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row_priority);

                    // current status of the invoice must be selected
                    if($title == "Normal"){
                        echo "<input id='priority_id_default' type='radio' name='priority_id' value='$id' checked/> $title ";
                    } else {
                        echo "<input type='radio' name='priority_id' value='$id' /> $title ";
                    }
                    
                }

            ?>
		</td>
	</tr>
    
    <tr>
		<td>Skip Artwork Phase *</td>
        <td>
            <select class='form-control' id='skip_artwork' name='skip_artwork' required>
                <option value='0' selected>No</option>
                <option value='1'>Yes</option>
            </select>
        </td>
	</tr>

    <tr>
		<td colspan="2" class="tableSubHeader" height="63px">Invoice</td>
	</tr>

    <tr>
		<td>Invoice: Date Due *</td>
        <td><input type='date' id='date_due' name='date_due' class='form-control' required/></td>
	</tr>

	<tr>
		<td>Total - Invoiced *</td>
		<td><input type='text' id='total_invoiced' name='total_invoiced' class='form-control' value='0.00' readonly='readonly') ?></td>
    </tr>

    <tr>
		<td colspan="2" class="tableSubHeader" height="63px">Client Reference</td>
	</tr>

    <tr>
		<td>Client Order Number</td>
		<td><input type='text' id='client_invoice_number' name='client_invoice_number' class='form-control' /></td>
	</tr>

    </table>
</form>

<?php

// check database for existing temporary line items
$total = $line_item_temp->countAll();

if($total>0){
    $item_count = 1;
    $stmt=$line_item_temp->read();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        echo "<h2 id='header{$item_count}'>Goods Received - {$item_count}</h2>";

        echo "<table class='table table-hover table-responsive table-bordered box'>";

            echo "<tr>";
                echo "<td colspan='2' class='tableSubHeader' height='63px'>Item</td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>Item</td>";
                echo "<td><input type='text' name='item' id='item_{$item_count}' value='{$item}' class='form-control' readonly='readonly'/>";
                echo "</td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td>Item - Quantity</td>";
                echo "<td><input type='text' name='item_qty' id='item_qty_{$item_count}' value='{$item_qty}' class='form-control' readonly='readonly'/></td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td colspan='2' class='tableSubHeader' height='63px'>Artwork</td>";
            echo "</tr>";
    
            echo "<td>Artwork - Logo</td>";
            echo "<td>";
                echo $artwork_logo ? "<img readonly='readonly' src='../images/{$artwork_logo}' style='width:300px;' />" : "No image found.";
            echo "</td>";
    
            echo "<tr>";
                echo "<td>Artwork - Position</td>";
                echo "<td><input type='text' name='artwork_position' id='artwork_position_{$item_count}' value='{$artwork_position}' class='form-control' readonly='readonly'/></td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td>Artwork - Color</td>";
                echo "<td><input type='text' name='artwork_color' id='artwork_color_{$item_count}' value='{$artwork_color}' class='form-control' readonly='readonly'/></td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td>Other Info</td>";
                echo "<td><input type='text' name='other_info' id='other_info_{$item_count}' value='{$other_info}' class='form-control' readonly='readonly'/></td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td colspan='2' class='tableSubHeader' height='63px'>Price</td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td>Price - Artwork</td>";
                echo "<td><input type='text' name='price_artwork' id='price_artwork_{$item_count}' value='{$price_artwork}' class='form-control' readonly='readonly'/></td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td>Price - Setup</td>";
                echo "<td><input type='text' name='price_setup' id='price_setup_{$item_count}' value='{$price_setup}' class='form-control' readonly='readonly'/></td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>Price - Embroidery</td>";
                echo "<td><input type='text' name='price_embroidery' id='price_embroidery_{$item_count}' value='{$price_embroidery}' class='form-control 'readonly='readonly'/></td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>Price - Sub Total</td>";
                echo "<td><input type='text' name='price_sub_total' id='price_sub_total_{$item_count}' value='0.00' class='form-control' readonly='readonly'/></td>";
            echo "</tr>";
    
            echo "<tr>";
                echo "<td colspan='2' class='submitButtonCol'>";
                    // delete line_item button
                    echo "<a delete-id='{$id}' class='btn btn-danger delete-object btn-block'>";
                        echo "<span class='glyphicon glyphicon-remove'</span> Delete";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
    
        echo "</table>";
        $item_count += 1;
    }
}   

?>

<form id="add_to_job_card" action="add_to_job_card.php" method="post" enctype="multipart/form-data" class="m-b-20px">

    <h2>Goods Received</h2>

    <table class='table table-hover table-responsive table-bordered box'>
        <tr>
            <td colspan='2' class='tableSubHeader' height='63px'>Item</td>
        </tr>

        <tr>
            <td>Item (Shirt, Cap, Jersey, etc)</td>
            <td><input type='text' name='item' id='item' class='form-control' required/></td>
        </tr>

        <tr>
            <td>Quantity</td>
            <td><input type='text' name='item_qty' id='item_qty' class='form-control' oninput='calculateSubTotal()' value='0' required/></td>
        </tr>

        <tr>
            <td colspan='2' class='tableSubHeader' height='63px'>Artwork</td>
        </tr>

        <tr>
            <td>Artwork - Logo</td>
            <td><input type='file' name='artwork_logo' id='artwork_logo' class='form-control' /></td>
        </tr>

        <tr>
            <td>Artwork - Position</td>
            <td><input type='text' name='artwork_position' id='artwork_position' class='form-control' /></td>
        </tr>

        <tr>
            <td>Artwork - Color</td>
            <td><input type='text' name='artwork_color' id='artwork_color' class='form-control' /></td>
        </tr>

        <tr>
            <td>Other Info</td>
            <td><input type='text' name='other_info' id='other_info' class='form-control' /></td>
        </tr>

        <tr>
            <td colspan='2' class='tableSubHeader' height='63px'>Price</td>
        </tr>

        <tr>
            <td>Price - Artwork</td>
            <td><input type='text' name='price_artwork' id='price_artwork' class='form-control' oninput='calculateSubTotal()' value='0' <?php echo (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "") ?>/></td>
        </tr>

        <tr>
            <td>Price - Setup</td>
            <td><input type='text' name='price_setup' id='price_setup' class='form-control' oninput='calculateSubTotal()' value='0' <?php echo (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "") ?>/></td>
        </tr>

        <tr>
            <td>Price - Per Embroidery</td>
            <td><input type='text' name='price_embroidery' id='price_embroidery' class='form-control' oninput='calculateSubTotal()' value='0' <?php echo (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "") ?>/></td>
        </tr>

       	<tr>
            <td colspan="2" height="67px" class="submitButtonCol"><button type="submit" class="btn btn-primary btn-block submitButton" onClick="setCookie()">Add</button></td>
        </tr>

    </table>
</form>

<div class="w-100-pct m-b-40px">
    <button id="jobCardSubmit" disabled class="btn btn-primary btn-block submitButtonJobCard" onClick="createJobCard()">save job card
    </button>
</div>

<?php
// footer 
include_once "layout_footer.php";
?>