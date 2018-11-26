<?php
// get ID of the line_item to be read
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

// set ID property of line_item to be read
$line_item->id = $id;

// read the details of line_item to be read
$line_item->readOne();

// set navigation
$nav_title = "Line_Item";

// set page headers
$page_title = "Read One Line_Item";
include_once "layout_header.php";

// read line_item button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Line_Item ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a line_item details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td></td>";
		echo "<td>{$line_item->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Job Card ID</td>";
		echo "<td>{$line_item->job_card_id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Item</td>";
		echo "<td>{$line_item->item}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Item - Quantity</td>";
		echo "<td>{$line_item->item_qty}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Item - Quantity Verified</td>";
		echo "<td>{$line_item->item_qty_verified}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Item - Quantity Information</td>";
		echo "<td>{$line_item->item_qty_info}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Artwork - Logo</td>";
		echo "<td>";
			echo $line_item->artwork_logo ? "<img src='../images/{$line_item->artwork_logo}' style='width:300px;' />" : "No image found.";
		echo "</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Artwork - Position</td>";
		echo "<td>{$line_item->artwork_position}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Artwork - Color</td>";
		echo "<td>{$line_item->artwork_color}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Other Info</td>";
		echo "<td>{$line_item->other_info}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Price - Artwork</td>";
		echo "<td>{$line_item->price_artwork}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Price - Setup</td>";
		echo "<td>{$line_item->price_setup}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Price - Embroidery</td>";
		echo "<td>{$line_item->price_embroidery}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Fulfilled</td>";
		echo "<td>{$line_item->fulfilled}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - Date</td>";
		echo "<td>{$line_item->created_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - By</td>";
		echo "<td>{$line_item->created_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - Date</td>";
		echo "<td>{$line_item->modified_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - By</td>";
		echo "<td>{$line_item->modified_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Row Source</td>";
		echo "<td>{$line_item->row_source}</td>";
	echo "</tr>";

echo "</table>";

// set footer
include_once "layout_footer.php";
?>