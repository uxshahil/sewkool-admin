<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/line_item.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$line_item = new Line_Item($db);

// set navigation
$nav_title = "Line_Item";

// set page headers
$page_title = "Create Line_Item";
include_once "layout_header.php";

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Line_Items</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set line_item property values
	$line_item->job_card_id = $_POST['job_card_id'];
	$line_item->item = $_POST['item'];
	$line_item->item_qty = $_POST['item_qty'];
	$line_item->item_qty_verified = $_POST['item_qty_verified'];
	$line_item->item_qty_info = $_POST['item_qty_info'];

    $image=!empty($_FILES["artwork_logo"]["name"])
        ? sha1_file($_FILES['artwork_logo']['tmp_name']) . "-" . basename($_FILES["artwork_logo"]["name"]) : "";
    $line_item->artwork_logo = $image;

	$line_item->artwork_position = $_POST['artwork_position'];
	$line_item->artwork_color = $_POST['artwork_color'];
	$line_item->other_info = $_POST['other_info'];
	$line_item->price_artwork = $_POST['price_artwork'];
	$line_item->price_setup = $_POST['price_setup'];
	$line_item->price_embroidery = $_POST['price_embroidery'];
	$line_item->fulfilled = $_POST['fulfilled'];

    // create the line_item
    if($line_item->create()){
        echo "<div class='alert alert-success'>Line_Item was created.</div>";

        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $line_item->uploadPhoto();
    }

    // if unable to create the line_item, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create line_item.</div>";
    }
}
?>

<!-- HTML form for creating a line_item -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Job Card ID</td>
			<td><input type='text' name='job_card_id' class='form-control' /></td>
		</tr>

		<tr>
			<td>Item</td>
			<td><input type='text' name='item' class='form-control' /></td>
		</tr>

		<tr>
			<td>Item - Quantity</td>
			<td><input type='text' name='item_qty' class='form-control' /></td>
		</tr>

		<tr>
			<td>Item - Quantity Verified</td>
			<td><input type='text' name='item_qty_verified' class='form-control' /></td>
		</tr>

		<tr>
			<td>Item - Quantity Information</td>
			<td><input type='text' name='item_qty_info' class='form-control' /></td>
		</tr>

		<tr>
			<td>Artwork - Logo</td>
			<td><input type='file' name='artwork_logo' class='form-control' /></td>
		</tr>

		<tr>
			<td>Artwork - Position</td>
			<td><input type='text' name='artwork_position' class='form-control' /></td>
		</tr>

		<tr>
			<td>Artwork - Color</td>
			<td><input type='text' name='artwork_color' class='form-control' /></td>
		</tr>

		<tr>
			<td>Other Info</td>
			<td><input type='text' name='other_info' class='form-control' /></td>
		</tr>

		<tr>
			<td>Price - Artwork</td>
			<td><input type='text' name='price_artwork' class='form-control' /></td>
		</tr>

		<tr>
			<td>Price - Setup</td>
			<td><input type='text' name='price_setup' class='form-control' /></td>
		</tr>

		<tr>
			<td>Price - Embroidery</td>
			<td><input type='text' name='price_embroidery' class='form-control' /></td>
		</tr>

		<tr>
			<td>Fulfilled</td>
			<td><input type='text' name='fulfilled' class='form-control' /></td>
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