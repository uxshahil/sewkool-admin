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
		echo "<td>Name</td>";
		echo "<td>{$user->name}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Contact - Number</td>";
		echo "<td>{$user->contact_number}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Contact - Email</td>";
		echo "<td>{$user->contact_email}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Contact - Number 2</td>";
		echo "<td>{$user->contact_number_2}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address - Hometown</td>";
		echo "<td>{$user->adr_home_town}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Username</td>";
		echo "<td>{$user->login_username}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Password</td>";
		echo "<td>{$user->login_password}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Facebook</td>";
		echo "<td>{$user->social_facebook_id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Instagram</td>";
		echo "<td>{$user->social_instagram_id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Twitter</td>";
		echo "<td>{$user->social_twitter_id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Youtube</td>";
		echo "<td>{$user->social_youtube_id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address - Line 0</td>";
		echo "<td>{$user->adr_line_0}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address - Line 1</td>";
		echo "<td>{$user->adr_line_1}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address - Line 2</td>";
		echo "<td>{$user->adr_line_2}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address - Line 3</td>";
		echo "<td>{$user->adr_line_3}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Address - Postal Code</td>";
		echo "<td>{$user->adr_code}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Province ID</td>";
		echo "<td>{$user->province_id}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Permission - Super Admin</td>";
		echo "<td>{$user->permission_super_admin}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Permission - Admin</td>";
		echo "<td>{$user->permission_admin}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Permission - User</td>";
		echo "<td>{$user->permission_user}</td>";
	echo "</tr>";

    echo "<tr>";
        echo "<td>Image</td>";
        echo "<td>";
            echo $user->image ? "<img src='uploads/{$user->image}' style='width:300px;' />" : "No image found.";
        echo "</td>";
    echo "</tr>";

	echo "<tr>";
		echo "<td>Permission - Finance</td>";
		echo "<td>{$user->permission_finance}</td>";
	echo "</tr>";

	echo "<tr>";
		echo "<td>Department</td>";
		echo "<td>{$user->department}</td>";
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