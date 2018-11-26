<?php
// get ID of the product to be edited
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

// set ID property of status to be edited
$status->id = $id;

// read the details of status to be edited
$status->readOne();

// set navigation
$nav_title = "Status";

// set page header
$page_title = "Update Status";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read Status</a>";
    echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set status property values
	$status->fk_table = $_POST['fk_table'];
	$status->fk_field = $_POST['fk_field'];
	$status->parent_id = $_POST['parent_id'];
	$status->title = $_POST['title'];
	$status->description = $_POST['description'];


// update the status
    if($status->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Status was updated.";
        echo "</div>";
    }

// if unable to update the status, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate status.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Referencing - Table</td>
			<td><input type='text' name='fk_table' value='<?php echo $status->fk_table; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Referencing - Field</td>
			<td><input type='text' name='fk_field' value='<?php echo $status->fk_field; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Parent</td>
			<td><input type='text' name='parent_id' value='<?php echo $status->parent_id; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Title</td>
			<td><input type='text' name='title' value='<?php echo $status->title; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Description</td>
			<td><input type='text' name='description' value='<?php echo $status->description; ?>' class='form-control' /></td>
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