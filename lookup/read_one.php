<?php
// get ID of the lookup to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/lookup.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$lookup = new Lookup($db);

// set ID property of lookup to be read
$lookup->id = $id;

// read the details of lookup to be read
$lookup->readOne();

// set navigation
$nav_title = "Lookup";

// set page headers
$page_title = "Read One Lookup";
include_once "layout_header.php";

// read lookup button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Lookup ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a lookup details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td>Primary Key</td>";
		echo "<td>{$lookup->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Collection</td>";
		echo "<td>{$lookup->collection}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td></td>";
		echo "<td>{$lookup->title}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - Date</td>";
		echo "<td>{$lookup->created_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - By</td>";
		echo "<td>{$lookup->created_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - Date</td>";
		echo "<td>{$lookup->modified_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - By</td>";
		echo "<td>{$lookup->modified_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Row Source</td>";
		echo "<td>{$lookup->row_source}</td>";
	echo "</tr>";



echo "</table>";

// set footer
include_once "layout_footer.php";
?>