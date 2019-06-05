<?php
// get ID of the user to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$user = new User($db);

// set ID property of user to be read
$user->id = $id;

// read the details of user to be read
$user->readOne();

// set navigation
$nav_title = "User";

// set page headers
$page_title = "Read One User";
include_once "layout_header.php";

// read user button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read User ";
    echo "</a>";
echo "</div>";

// HTML table for displaying a user details
echo "<table class='table table-hover table-responsive table-bordered box'>";

	echo "<tr>";
		echo "<td>Primary Key</td>";
		echo "<td>{$user->id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>First Name</td>";
		echo "<td>{$user->first_name}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Last Name</td>";
		echo "<td>{$user->last_name}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Contact - Email</td>";
		echo "<td>{$user->contact_email}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Contact - Number</td>";
		echo "<td>{$user->contact_number}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address</td>";
		echo "<td>{$user->address}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Password</td>";
		echo "<td>{$user->password}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Access Level</td>";
		echo "<td>{$user->access_level}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Access Code</td>";
		echo "<td>{$user->access_code}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Status</td>";
		echo "<td>{$user->status}</td>";
	echo "</tr>";

    echo "<tr>";
        echo "<td>Image</td>";
        echo "<td>";
            echo $user->image ? "<img src='uploads/{$user->image}' style='width:300px;' />" : "No image found.";
        echo "</td>";
    echo "</tr>";

	echo "<tr>";
		echo "<td>Created - Date</td>";
		echo "<td>{$user->created_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Created - By</td>";
		echo "<td>{$user->created_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - Date</td>";
		echo "<td>{$user->modified_date}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Modified - By</td>";
		echo "<td>{$user->modified_by}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Row Source</td>";
		echo "<td>{$user->row_source}</td>";
	echo "</tr>";



echo "</table>";

// set footer
include_once "layout_footer.php";
?>