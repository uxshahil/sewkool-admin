<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/business.php';
include_once '../objects/status.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$business = new Business($db);
$status = new Status($db);

// set ID property of business to be edited
$business->id = $id;

// read the details of business to be edited
$business->readOne();

// set navigation
$nav_title = "Business";

// set page header
$page_title = "Update Business";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read Business</a>";
    echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set business property values
	$business->name = $_POST['name'];
	$business->description = $_POST['description'];
	$business->head_office = $_POST['head_office'];
	$business->branch_name = $_POST['branch_name'];
	$business->adr_postal = $_POST['adr_postal'];
	$business->adr_location = $_POST['adr_location'];
	$business->contact_primary_name = $_POST['contact_primary_name'];
	$business->contact_primary_number = $_POST['contact_primary_number'];
	$business->contact_primary_email = $_POST['contact_primary_email'];
	$business->contact_secondary_name = $_POST['contact_secondary_name'];
	$business->contact_secondary_number = $_POST['contact_secondary_number'];
	$business->contact_secondary_email = $_POST['contact_secondary_email'];
	$business->contact_business_number = $_POST['contact_business_number'];
	$business->contact_business_email = $_POST['contact_business_email'];
	$business->contact_business_www = $_POST['contact_business_www'];
	$business->contact_business_twitter = $_POST['contact_business_twitter'];
	$business->contact_business_facebook = $_POST['contact_business_facebook'];
	$business->contact_business_instagram = $_POST['contact_business_instagram'];
	$business->contact_business_youtube = $_POST['contact_business_youtube'];
	$business->vat = $_POST['vat'];
	$business->company_registration = $_POST['company_registration'];
	$business->account_status_id = $_POST['account_status_id'];


// update the business
    if($business->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Business was updated.";
        echo "</div>";
    }

// if unable to update the business, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate business.";
        echo "</div>";
    }
}
?>

<form name="business_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Name</td>
			<td><input type='text' name='name' value='<?php echo $business->name; ?>' class='form-control' maxlength="50" /></td>
		</tr>

		<tr>
			<td>Description</td>
			<td><input type='text' name='description' value='<?php echo $business->description; ?>' class='form-control' maxlength="255" /></td>
		</tr>

		<tr>
			<td>Head Office</td>
			<td><input type='text' name='head_office' value='<?php echo $business->head_office; ?>' class='form-control' maxlength="@@@" /></td>
		</tr>

		<tr>
			<td>Branch Name</td>
			<td><input type='text' name='branch_name' value='<?php echo $business->branch_name; ?>' class='form-control' maxlength="50" /></td>
		</tr>

		<tr>
			<td>Address - Postal</td>
			<td><input type='text' name='adr_postal' value='<?php echo $business->adr_postal; ?>' class='form-control' maxlength="150" /></td>
		</tr>

		<tr>
			<td>Address- Location</td>
			<td><input type='text' name='adr_location' value='<?php echo $business->adr_location; ?>' class='form-control' maxlength="150" /></td>
		</tr>

		<tr>
			<td>Primary Contact: Name</td>
			<td><input type='text' name='contact_primary_name' value='<?php echo $business->contact_primary_name; ?>' class='form-control' maxlength="50" onchange="validateLettersOnly(document.business_form.contact_primary_name, 'contact_primary_name')"/></td>
		</tr>

		<tr>
			<td>Primary Contact: Number</td>
			<td><input type='text' name='contact_primary_number' value='<?php echo $business->contact_primary_number; ?>' class='form-control' maxlength="15" onchange="validatePhoneNumber(document.business_form.contact_primary_number, 'contact_primary_number')"/></td>
		</tr>

		<tr>
			<td>Primary Contact: Email</td>
			<td><input type='text' name='contact_primary_email' value='<?php echo $business->contact_primary_email; ?>' class='form-control' maxlength="50" onchange="validateEmail(document.business_form.contact_primary_email, 'contact_primary_email')"/></td>
		</tr>

		<tr>
			<td>Secondary Contact: Name</td>
			<td><input type='text' name='contact_secondary_name' value='<?php echo $business->contact_secondary_name; ?>' class='form-control' maxlength="50" onchange="validateLettersOnly(document.business_form.contact_secondary_name, 'contact_secondary_name')"/></td>
		</tr>

		<tr>
			<td>Secondary Contact: Number</td>
			<td><input type='text' name='contact_secondary_number' value='<?php echo $business->contact_secondary_number; ?>' class='form-control' maxlength="15" onchange="validatePhoneNumber(document.business_form.contact_secondary_number, 'contact_secondary_number')"/></td>
		</tr>

		<tr>
			<td>Secondary Contact: Email</td>
			<td><input type='text' name='contact_secondary_email' value='<?php echo $business->contact_secondary_email; ?>' class='form-control' maxlength="15" onchange="validateEmail(document.business_form.contact_secondary_email, 'contact_secondary_email')"/></td>
		</tr>

		<tr>
			<td>Business: Number</td>
			<td><input type='text' name='contact_business_number' value='<?php echo $business->contact_business_number; ?>' class='form-control' maxlength="15" onchange="validatePhoneNumber(document.business_form.contact_business_number, 'contact_business_number')"/></td>
		</tr>

		<tr>
			<td>Business: Email</td>
			<td><input type='text' name='contact_business_email' value='<?php echo $business->contact_business_email; ?>' class='form-control' maxlength="50" onchange="validateEmail(document.business_form.contact_business_email, 'contact_business_email')"/></td>
		</tr>

		<tr>
			<td>Website</td>
			<td><input type='text' name='contact_business_www' value='<?php echo $business->contact_business_www; ?>' class='form-control' maxlength="50" /></td>
		</tr>

		<tr>
			<td>Twitter</td>
			<td><input type='text' name='contact_business_twitter' value='<?php echo $business->contact_business_twitter; ?>' class='form-control' maxlength="50" /></td>
		</tr>

		<tr>
			<td>Facebook</td>
			<td><input type='text' name='contact_business_facebook' value='<?php echo $business->contact_business_facebook; ?>' class='form-control' maxlength="50" /></td>
		</tr>

		<tr>
			<td>Instagram</td>
			<td><input type='text' name='contact_business_instagram' value='<?php echo $business->contact_business_instagram; ?>' class='form-control' maxlength="50" /></td>
		</tr>

		<tr>
			<td>YouTube</td>
			<td><input type='text' name='contact_business_youtube' value='<?php echo $business->contact_business_youtube; ?>' class='form-control' maxlength="50" /></td>
		</tr>

		<tr>
			<td>Vat</td>
			<td><input type='text' name='vat' value='<?php echo $business->vat; ?>' class='form-control' maxlength = "25" onchange="validateNumericOnly(document.business_form.vat, 'vat')"/></td>
		</tr>

		<tr>
			<td>Company Registration</td>
			<td><input type='text' name='company_registration' value='<?php echo $business->company_registration; ?>' class='form-control'  maxlength = "25" onchange="validateNumericOnly(document.business_form.company_registration, 'company_registration')"/></td>
		</tr>

        <tr>
			<td>Account  - Status</td>
            <td>
                <?php
                $stmt = $status->readParentStatus('Business', 'account_status_id');

                // put them in a select drop-down
                echo "<select class='form-control' name='account_status_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $status_id = $row_status['id'];
                        $status_title = $row_status['title'];

                        // current status of the invoice must be selected
                        if($business->account_status_id==$status_id){
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