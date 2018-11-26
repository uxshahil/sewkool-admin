<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/business.php';
include_once '../objects/status.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$business = new Business($db);
$status = new Status($db);

// set navigation
$nav_title = "Business";

// set page headers
$page_title = "Create Business";
include_once "layout_header.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";

if($action=='from_job_card_process'){
	$redirect = "../job_card_process/create_customer.php";
}
else
{
	$redirect = htmlspecialchars($_SERVER["PHP_SELF"]);
}

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Businesss</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
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

	$image=!empty($_FILES["image"]["name"])
		? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$business->image = $image;
	
	$business->vat = $_POST['vat'];
	$business->company_registration = $_POST['company_registration'];
	$business->account_status_id = $_POST['account_status_id'];

    // create the business
    if($business->create()){
        echo "<div class='alert alert-success'>Business was created.</div>";

        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
		echo $business->uploadPhoto();
    }

    // if unable to create the business, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create business.</div>";
    }
}
?>

<!-- HTML form for creating a business -->

<form name="business_form" action=<?php echo $redirect ?> method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

	<tr>
		<td>Name</td>
		<td><input type='text' name='name' class='form-control' maxlength="50" /></td>
	</tr>

	<tr>
		<td>Description</td>
		<td><input type='text' name='description' class='form-control' maxlength="255" /></td>
	</tr>

	<tr>
		<td>Head Office</td>
		<td><input type='text' name='head_office' class='form-control' value='1' maxlength="@@@" /></td>
	</tr>

	<tr>
		<td>Branch Name</td>
		<td><input type='text' name='branch_name' class='form-control' maxlength="50" /></td>
	</tr>

	<tr>
		<td>Address - Postal</td>
		<td><input type='text' name='adr_postal' class='form-control' maxlength="150" /></td>
	</tr>

	<tr>
		<td>Address- Location</td>
		<td><input type='text' name='adr_location' class='form-control' maxlength="150" /></td>
	</tr>

	<tr>
		<td>Primary Contact: Name</td>
		<td><input type='text' name='contact_primary_name' class='form-control' maxlength="50" onchange="validateLettersOnly(document.business_form.contact_primary_name, 'contact_primary_name')"/></td>
	</tr>

	<tr>
		<td>Primary Contact: Number</td>
		<td><input type='text' name='contact_primary_number' class='form-control' maxlength="10" onchange="validatePhoneNumber(document.business_form.contact_primary_number, 'contact_primary_number')"/></td>
	</tr>

	<tr>
		<td>Primary Contact: Email</td>
		<td><input type='text' name='contact_primary_email' class='form-control' maxlength="50" onchange="validateEmail(document.business_form.contact_primary_email, 'contact_primary_email')"/></td>
	</tr>

	<tr>
		<td>Secondary Contact: Name</td>
		<td><input type='text' name='contact_secondary_name' class='form-control' maxlength="50" onchange="validateLettersOnly(document.business_form.contact_secondary_name, 'contact_secondary_name')"/></td>
	</tr>

	<tr>
		<td>Secondary Contact: Number</td>
		<td><input type='text' name='contact_secondary_number' class='form-control' maxlength="10" onchange="validatePhoneNumber(document.business_form.contact_secondary_number, 'contact_secondary_number')"/></td>
	</tr>

	<tr>
		<td>Secondary Contact: Email</td>
		<td><input type='text' name='contact_secondary_email' class='form-control' maxlength="50" onchange="validateEmail(document.business_form.contact_secondary_email, 'contact_secondary_email')"/></td>
	</tr>

	<tr>
		<td>Business: Number</td>
		<td><input type='text' name='contact_business_number' class='form-control' maxlength="10" onchange="validatePhoneNumber(document.business_form.contact_business_number, 'contact_business_number')"/></td>
	</tr>

	<tr>
		<td>Business: Email</td>
		<td><input type='text' name='contact_business_email' class='form-control' maxlength="50" onchange="validateEmail(document.business_form.contact_business_email, 'contact_business_email')"/></td>
	</tr>

	<tr>
		<td>Website</td>
		<td><input type='text' name='contact_business_www' class='form-control' maxlength="50" /></td>
	</tr>

	<tr>
		<td>Twitter</td>
		<td><input type='text' name='contact_business_twitter' class='form-control' maxlength="50" /></td>
	</tr>

	<tr>
		<td>Facebook</td>
		<td><input type='text' name='contact_business_facebook' class='form-control' maxlength="50" /></td>
	</tr>

	<tr>
		<td>Instagram</td>
		<td><input type='text' name='contact_business_instagram' class='form-control' maxlength="50" /></td>
	</tr>

	<tr>
		<td>YouTube</td>
		<td><input type='text' name='contact_business_youtube' class='form-control' maxlength="50" /></td>
	</tr>

	<tr>
		<td>Photo</td>
		<td><input type="file" name="image" /></td>
	</tr>

	<tr>
		<td>Vat</td>
		<td><input type='text' name='vat' class='form-control' maxlength = "25" onchange="validateNumericOnly(document.business_form.vat, 'vat')"/></td>
	</tr>

	<tr>
		<td>Company Registration</td>
		<td><input type='text' name='company_registration' class='form-control' maxlength = "25" onchange="validateNumericOnly(document.business_form.company_registration, 'company_registration')"/></td>
	</tr>

    <tr>
        <td>Account Status</td>
        <td>
        
        <?php
        // read the product categories from the database
        $stmt = $status->readParentStatus('Business', 'account_status_id');
        
        // put them in a select drop-down
        echo "<select id='account_status_id' class='form-control' name='account_status_id'>";
            echo "<option>Select status...</option>";

            while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_status);
                echo "<option value='{$id}'>{$title}</option>";
            }

        echo "</select>";
        ?>

        </td>
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