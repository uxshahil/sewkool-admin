<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../objects/lookup.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$user = new User($db);
$lookup = new Lookup($db);

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
	$user->first_name = $_POST['first_name'];
	$user->last_name = $_POST['last_name'];
	$user->contact_email = $_POST['contact_email'];
	$user->contact_number = $_POST['contact_number'];
	$user->address = $_POST['address'];
	$user->password = $_POST['password'];
	$user->access_level = $_POST['access_level'];
	$user->access_code = $_POST['access_code'];
	$user->status = $_POST['status'];

	$image=!empty($_FILES["image"]["name"])
		? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$user->image = $image;

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
			<td colspan="2" class="tableSubHeader" height="63px">User</td>
		</tr>
		
		<tr>
			<td>First Name</td>
			<td><input type='text' name='first_name' class='form-control' /></td>
		</tr>

		<tr>
			<td>Last Name</td>
			<td><input type='text' name='last_name' class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" class="tableSubHeader" height="63px">Contact</td>
		</tr>

		<tr>
			<td>Contact - Email</td>
			<td><input type='text' name='contact_email' class='form-control' /></td>
		</tr>

		<tr>
			<td>Contact - Number</td>
			<td><input type='text' name='contact_number' class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" class="tableSubHeader" height="63px">Address</td>
		</tr>

		<tr>
			<td>Address</td>
			<td><input type='text' name='address' class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" class="tableSubHeader" height="63px">Access</td>
		</tr>

		<tr>
			<td>Password</td>
			<td><input type='text' name='password' class='form-control' /></td>
		</tr>

		<tr>
			<td>Access Level</td>
			<td>
			<?php
			// read the product categories from the database
			$stmt = $lookup->readCollection("access_level");
			
			// put them in a select drop-down
			echo "<select id='access_level' class='form-control' name='access_level'>";
				echo "<option>Select Access Level...</option>";

				while ($row_payment_method = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row_payment_method);
					echo "<option value='{$title}'>{$title}</option>";
				}

			echo "</select>";
			?>
			</td>
		</tr>

		<tr>
			<td>Access Code</td>
			<td><input type='text' name='access_code' class='form-control' readonly='readonly'/></td>
		</tr>

		<tr>
			<td colspan="2" class="tableSubHeader" height="63px">Extra</td>
		</tr>

		<tr>
			<td>Status</td>
			<td><input type='text' name='status' class='form-control' /></td>
		</tr>

		<tr>
			<td>Image</td>
			<td><input type='text' name='image' class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" height="67px" class="submitButtonCol">
				<button type="submit" class="btn btn-primary btn-block submitButton">Create</button>
			</td>
		</tr>

	</table>
</form>

<?php

// footer 
include_once "layout_footer.php";
?>