<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../objects/lookup.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$user = new User($db);
$lookup = new Lookup($db);

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
	$user->id = $_POST['id'];
	$user->first_name = $_POST['first_name'];
	$user->last_name = $_POST['last_name'];
	$user->contact_email = $_POST['contact_email'];
	$user->contact_number = $_POST['contact_number'];
	$user->address = $_POST['address'];
	$user->password = $_POST['password'];
	$user->access_level = $_POST['access_level'];
	$user->access_code = $_POST['access_code'];
	$user->status = $_POST['status'];

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
			<td colspan="2" class="tableSubHeader" height="63px">User</td>
		</tr>

		<tr>
			<td>First Name</td>
			<td><input type='text' name='first_name' value='<?php echo $user->first_name; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Last Name</td>
			<td><input type='text' name='last_name' value='<?php echo $user->last_name; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" class="tableSubHeader" height="63px">Contact</td>
		</tr>

		<tr>
			<td>Contact - Email</td>
			<td><input type='text' name='contact_email' value='<?php echo $user->contact_email; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Contact - Number</td>
			<td><input type='text' name='contact_number' value='<?php echo $user->contact_number; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" class="tableSubHeader" height="63px">Address</td>
		</tr>

		<tr>
			<td>Address</td>
			<td><input type='text' name='address' value='<?php echo $user->address; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" class="tableSubHeader" height="63px">Access</td>
		</tr>

		<tr>
			<td>Password</td>
			<td><input type='text' name='password' value='<?php echo $user->password; ?>' readonly="readonly" class='form-control' /></td>
		</tr>

		<tr>
			<td>Access Level</td>
            <td>
                <?php
                $stmt = $lookup->readCollection("access_level");

                // put them in a select drop-down
                echo "<select class='form-control' name='access_level'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_access_level = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $access_level_id = $row_access_level['id'];
                        $access_level_title = $row_access_level['title'];

                        // current status of the invoice must be selected
                        if($user->access_level==$access_level_title){
                            echo "<option value='$access_level_title' selected>";
                        } else {
                            echo "<option value='$access_level_title'>";
                        }

                        echo "$access_level_title</option>";
                    }
                echo "</select>";
                ?>
            </td>
		</tr>

		<tr>
			<td>Access Code</td>
			<td><input type='text' name='access_code' value='<?php echo $user->access_code; ?>' readonly="readonly" class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" class="tableSubHeader" height="63px">Extra</td>
		</tr>

		<tr>
			<td>Status</td>
			<td><input type='text' name='status' value='<?php echo $user->status; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td colspan="2" height="67px" class="submitButtonCol">
				<button type="submit" class="btn btn-primary btn-block submitButton">Create</button>
			</td>
		</tr>
    </table>
</form>

<?php

// set page footer
include_once "layout_footer.php";
?>