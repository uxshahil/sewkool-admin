<?php
// get ID of the status_history to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// include database and object files
include_once '../config/database.php';
include_once '../objects/status_history.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$status_history = new Status_History($db);

// set ID property of status_history to be read
$status_history->id = $id;

// read the details of status_history to be read
$status_history->readOne();

// set navigation
$nav_title = "Status_History";

// set page headers
$page_title = "Read One Status_History";
include_once "layout_header.php";

// read status_history button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Status_History ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a status_history details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td>Primary Key</td>";
		echo "<td>{$status_history->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Referencing - Table</td>";
		echo "<td>{$status_history->fk_table}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Referencing - Field</td>";
		echo "<td>{$status_history->fk_field}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Parent</td>";
		echo "<td>{$status_history->fk_field_pk}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Title</td>";
		echo "<td>{$status_history->title}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - Date</td>";
		echo "<td>{$status_history->created_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - By</td>";
		echo "<td>{$status_history->created_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - Date</td>";
		echo "<td>{$status_history->modified_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - By</td>";
		echo "<td>{$status_history->modified_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Row Source</td>";
		echo "<td>{$status_history->row_source}</td>";
	echo "</tr>";



echo "</table>";

// set footer
include_once "layout_footer.php";
?>