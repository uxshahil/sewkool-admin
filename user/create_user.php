<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/user.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$user = new User($db);

// set navigation
$nav_title = "User";

// set page headers
$page_title = "Create User";
include_once "layout_header.php";

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Users</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
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

	$image=!empty($_FILES["image"]["name"])
		? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$user->image = $image;
	
	$user->permission_finance = $_POST['permission_finance'];
	$user->department = $_POST['department'];

    // create the user
    if($user->create()){
        echo "<div class='alert alert-success'>User was created.</div>";

        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $user->uploadPhoto();
    }

    // if unable to create the user, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create user.</div>";
    }
} 
?>

<!-- HTML form for creating a user -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

	<tr>
		<td>Name</td>
		<td><input type='text' name='name' class='form-control' /></td>
	</tr>

	<tr>
		<td>Contact - Number</td>
		<td><input type='text' name='contact_number' class='form-control' /></td>
	</tr>

	<tr>
		<td>Contact - Email</td>
		<td><input type='text' name='contact_email' class='form-control' /></td>
	</tr>

	<tr>
		<td>Contact - Number 2</td>
		<td><input type='text' name='contact_number_2' class='form-control' /></td>
	</tr>

	<tr>
		<td>Address - Hometown</td>
		<td><input type='text' name='adr_home_town' class='form-control' /></td>
	</tr>

	<tr>
		<td>Username</td>
		<td><input type='text' name='login_username' class='form-control' /></td>
	</tr>

	<tr>
		<td>Password</td>
		<td><input type='text' name='login_password' class='form-control' /></td>
	</tr>

	<tr>
		<td>Facebook</td>
		<td><input type='text' name='social_facebook_id' class='form-control' /></td>
	</tr>

	<tr>
		<td>Instagram</td>
		<td><input type='text' name='social_instagram_id' class='form-control' /></td>
	</tr>

	<tr>
		<td>Twitter</td>
		<td><input type='text' name='social_twitter_id' class='form-control' /></td>
	</tr>

	<tr>
		<td>Youtube</td>
		<td><input type='text' name='social_youtube_id' class='form-control' /></td>
	</tr>

	<tr>
		<td>Address - Line 0</td>
		<td><input type='text' name='adr_line_0' class='form-control' /></td>
	</tr>

	<tr>
		<td>Address - Line 1</td>
		<td><input type='text' name='adr_line_1' class='form-control' /></td>
	</tr>

	<tr>
		<td>Address - Line 2</td>
		<td><input type='text' name='adr_line_2' class='form-control' /></td>
	</tr>

	<tr>
		<td>Address - Line 3</td>
		<td><input type='text' name='adr_line_3' class='form-control' /></td>
	</tr>

	<tr>
		<td>Address - Postal Code</td>
		<td><input type='text' name='adr_code' class='form-control' /></td>
	</tr>

	<tr>
		<td>Province ID</td>
		<td><input type='text' name='province_id' class='form-control' /></td>
	</tr>

	<tr>
		<td>Permission - Super Admin</td>
		<td><input type='text' name='permission_super_admin' class='form-control' /></td>
	</tr>

	<tr>
		<td>Permission - Admin</td>
		<td><input type='text' name='permission_admin' class='form-control' /></td>
	</tr>

	<tr>
		<td>Permission - User</td>
		<td><input type='text' name='permission_user' class='form-control' /></td>
	</tr>

	<tr>
		<td>Photo</td>
		<td><input type="file" name="image" /></td>
	</tr>

	<tr>
		<td>Permission - Finance</td>
		<td><input type='text' name='permission_finance' class='form-control' /></td>
	</tr>

	<tr>
		<td>Department</td>
		<td><input type='text' name='department' class='form-control' /></td>
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