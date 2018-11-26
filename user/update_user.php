<?php
// get ID of the product to be edited
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

// set ID property of user to be edited
$user->id = $id;

// read the details of user to be edited
$user->readOne();

// set navigation
$nav_title = "User";

// set page header
$page_title = "Update User";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read User</a>";
    echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set user property values
	$user->name = $_POST['name'];
	$user->contact_number = $_POST['contact_number'];
	$user->contact_email = $_POST['contact_email'];
	$user->contact_number_2 = $_POST['contact_number_2'];
	$user->adr_home_town = $_POST['adr_home_town'];
	$user->login_username = $_POST['login_username'];
	$user->login_password = $_POST['login_password'];
	$user->social_facebook_id = $_POST['social_facebook_id'];
	$user->social_instagram_id = $_POST['social_instagram_id'];
	$user->social_twitter_id = $_POST['social_twitter_id'];
	$user->social_youtube_id = $_POST['social_youtube_id'];
	$user->adr_line_0 = $_POST['adr_line_0'];
	$user->adr_line_1 = $_POST['adr_line_1'];
	$user->adr_line_2 = $_POST['adr_line_2'];
	$user->adr_line_3 = $_POST['adr_line_3'];
	$user->adr_code = $_POST['adr_code'];
	$user->province_id = $_POST['province_id'];
	$user->permission_super_admin = $_POST['permission_super_admin'];
	$user->permission_admin = $_POST['permission_admin'];
	$user->permission_user = $_POST['permission_user'];
	$user->permission_finance = $_POST['permission_finance'];
	$user->department = $_POST['department'];

// update the user
    if($user->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "User was updated.";
        echo "</div>";
    }

// if unable to update the user, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate user.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Name</td>
			<td><input type='text' name='name' value='<?php echo $user->name; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Contact - Number</td>
			<td><input type='text' name='contact_number' value='<?php echo $user->contact_number; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Contact - Email</td>
			<td><input type='text' name='contact_email' value='<?php echo $user->contact_email; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Contact - Number 2</td>
			<td><input type='text' name='contact_number_2' value='<?php echo $user->contact_number_2; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Address - Hometown</td>
			<td><input type='text' name='adr_home_town' value='<?php echo $user->adr_home_town; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Username</td>
			<td><input type='text' name='login_username' value='<?php echo $user->login_username; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Password</td>
			<td><input type='text' name='login_password' value='<?php echo $user->login_password; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Facebook</td>
			<td><input type='text' name='social_facebook_id' value='<?php echo $user->social_facebook_id; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Instagram</td>
			<td><input type='text' name='social_instagram_id' value='<?php echo $user->social_instagram_id; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Twitter</td>
			<td><input type='text' name='social_twitter_id' value='<?php echo $user->social_twitter_id; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Youtube</td>
			<td><input type='text' name='social_youtube_id' value='<?php echo $user->social_youtube_id; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Address - Line 0</td>
			<td><input type='text' name='adr_line_0' value='<?php echo $user->adr_line_0; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Address - Line 1</td>
			<td><input type='text' name='adr_line_1' value='<?php echo $user->adr_line_1; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Address - Line 2</td>
			<td><input type='text' name='adr_line_2' value='<?php echo $user->adr_line_2; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Address - Line 3</td>
			<td><input type='text' name='adr_line_3' value='<?php echo $user->adr_line_3; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Address - Postal Code</td>
			<td><input type='text' name='adr_code' value='<?php echo $user->adr_code; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Province ID</td>
			<td><input type='text' name='province_id' value='<?php echo $user->province_id; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Permission - Super Admin</td>
			<td><input type='text' name='permission_super_admin' value='<?php echo $user->permission_super_admin; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Permission - Admin</td>
			<td><input type='text' name='permission_admin' value='<?php echo $user->permission_admin; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Permission - User</td>
			<td><input type='text' name='permission_user' value='<?php echo $user->permission_user; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Permission - Finance</td>
			<td><input type='text' name='permission_finance' value='<?php echo $user->permission_finance; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Department</td>
			<td><input type='text' name='department' value='<?php echo $user->department; ?>' class='form-control' /></td>
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