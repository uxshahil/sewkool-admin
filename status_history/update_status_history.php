<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// include database and object files
include_once '../config/database.php';
include_once '../objects/status_history.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$status_history = new Status_History($db);

// set ID property of status_history to be edited
$status_history->id = $id;

// read the details of status_history to be edited
$status_history->readOne();

// set navigation
$nav_title = "Status_History";

// set page header
$page_title = "Update Status_History";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read Status_History</a>";
    echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set status_history property values
	$status_history->id = $_POST['id'];
	$status_history->fk_table = $_POST['fk_table'];
	$status_history->fk_field = $_POST['fk_field'];
	$status_history->fk_field_pk = $_POST['fk_field_pk'];
	$status_history->title = $_POST['title'];

// update the status_history
    if($status_history->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Status_History was updated.";
        echo "</div>";
    }

// if unable to update the status_history, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate status_history.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Primary Key</td>
			<td><input type='text' name='id' value='<?php echo $status_history->id; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Referencing - Table</td>
			<td><input type='text' name='fk_table' value='<?php echo $status_history->fk_table; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Referencing - Field</td>
			<td><input type='text' name='fk_field' value='<?php echo $status_history->fk_field; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Parent</td>
			<td><input type='text' name='fk_field_pk' value='<?php echo $status_history->fk_field_pk; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Title</td>
			<td><input type='text' name='title' value='<?php echo $status_history->title; ?>' class='form-control' /></td>
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