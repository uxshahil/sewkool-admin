<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/line_item.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$line_item = new Line_Item($db);

// set ID property of line_item to be edited
$line_item->id = $id;

// read the details of line_item to be edited
$line_item->readOne();

// set navigation
$nav_title = "Line_Item";

// set page header
$page_title = "Update Line_Item";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read Line_Item</a>";
	echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set line_item property values
	$line_item->job_card_id = $_POST['job_card_id'];
	$line_item->item = $_POST['item'];
	$line_item->item_qty = $_POST['item_qty'];
	$line_item->item_qty_verified = $_POST['item_qty_verified'];
	$line_item->item_qty_info = $_POST['item_qty_info'];

    $image=!empty($_FILES['artwork_logo_new']['name'])
        ? sha1_file($_FILES['artwork_logo_new']['tmp_name']) . "-" . basename($_FILES["artwork_logo_new"]["name"]) : "";
    $line_item->artwork_logo = $image;

	$line_item->artwork_position = $_POST['artwork_position'];
	$line_item->artwork_color = $_POST['artwork_color'];
	$line_item->other_info = $_POST['other_info'];
	$line_item->price_artwork = $_POST['price_artwork'];
	$line_item->price_setup = $_POST['price_setup'];
	$line_item->price_embroidery = $_POST['price_embroidery'];
	$line_item->fulfilled = $_POST['fulfilled'];

// update the line_item
    if($line_item->update()){

        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Line_Item was updated.";
		echo "</div>";

		// try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $line_item->updatePhoto();
    }

// if unable to update the line_item, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate line_item.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post" enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Job Card ID</td>
			<td><input type='text' name='job_card_id' value='<?php echo $line_item->job_card_id; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Item</td>
			<td><input type='text' name='item' value='<?php echo $line_item->item; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Item - Quantity</td>
			<td><input type='text' name='item_qty' value='<?php echo $line_item->item_qty; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Item - Quantity Verified</td>
			<td><input type='text' name='item_qty_verified' value='<?php echo $line_item->item_qty_verified; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Item - Quantity Information</td>
			<td><input type='text' name='item_qty_info' value='<?php echo $line_item->item_qty_info; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Artwork - Logo</td>			
			<?php echo ($line_item->artwork_logo != "") ? "<td><img src='../images/{$line_item->artwork_logo}' style='width:300px;' /></td> <td> <input type='file' name='artwork_logo_new' class='form-control' /> </td>" : "<td><input type='file' name='artwork_logo_new' class='form-control' /> </td>"; ?>
		</tr>

		<tr>
			<td>Artwork - Position</td>
			<td><input type='text' name='artwork_position' value='<?php echo $line_item->artwork_position; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Artwork - Color</td>
			<td><input type='text' name='artwork_color' value='<?php echo $line_item->artwork_color; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Other Info</td>
			<td><input type='text' name='other_info' value='<?php echo $line_item->other_info; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Price - Artwork</td>
			<td><input type='text' name='price_artwork' value='<?php echo $line_item->price_artwork; ?>' class='form-control' <?php echo (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "") ?>/></td>
		</tr>

		<tr>
			<td>Price - Setup</td>
			<td><input type='text' name='price_setup' value='<?php echo $line_item->price_setup; ?>' class='form-control' <?php echo (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "") ?>/></td>
		</tr>

		<tr>
			<td>Price - Embroidery</td>
			<td><input type='text' name='price_embroidery' value='<?php echo $line_item->price_embroidery; ?>' class='form-control' <?php echo (($_SESSION['access_level']!="Admin") ? " readonly='readonly'" : "") ?>/></td>
		</tr>

		<tr>
			<td>Fulfilled</td>
			<td><input type='text' name='fulfilled' value='<?php echo $line_item->fulfilled; ?>' class='form-control' /></td>
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