<?php
// get ID of the status to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/status.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$status = new Status($db);

// set ID property of status to be read
$status->id = $id;

// read the details of status to be read
$status->readOne();

// set navigation
$nav_title = "Status";

// set page headers
$page_title = "Read One Status";
include_once "layout_header.php";

// read status button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Status ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a status details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td>Primary Key</td>";
		echo "<td>{$status->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Referencing - Table</td>";
		echo "<td>{$status->fk_table}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Referencing - Field</td>";
		echo "<td>{$status->fk_field}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Parent</td>";
		echo "<td>{$status->parent_id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Title</td>";
		echo "<td>{$status->title}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Description</td>";
		echo "<td>{$status->description}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - Date</td>";
		echo "<td>{$status->created_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - By</td>";
		echo "<td>{$status->created_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - Date</td>";
		echo "<td>{$status->modified_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - By</td>";
		echo "<td>{$status->modified_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Row Source</td>";
		echo "<td>{$status->row_source}</td>";
	echo "</tr>";



echo "</table>";

// set footer
include_once "layout_footer.php";
?>