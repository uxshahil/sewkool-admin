<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/status_history.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$status_history = new Status_History($db);

// set navigation
$nav_title = "Status_History";

// set page headers
$page_title = "Create Status_History";
include_once "layout_header.php";

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Status_Historys</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set status_history property values
	$status_history->id = $_POST['id'];
	$status_history->fk_table = $_POST['fk_table'];
	$status_history->fk_field = $_POST['fk_field'];
	$status_history->fk_field_pk = $_POST['fk_field_pk'];
	$status_history->title = $_POST['title'];
	$status_history->created_date = $_POST['created_date'];
	$status_history->created_by = $_POST['created_by'];
	$status_history->modified_date = $_POST['modified_date'];
	$status_history->modified_by = $_POST['modified_by'];
	$status_history->row_source = $_POST['row_source'];

    // create the status_history
    if($status_history->create()){
        echo "<div class='alert alert-success'>Status_History was created.</div>";

        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $status_history->uploadPhoto();
    }

    // if unable to create the status_history, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create status_history.</div>";
    }
}
?>

<!-- HTML form for creating a status_history -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

	<tr>
		<td>Primary Key</td>
		<td><input type='text' name='id' class='form-control' /></td>
	</tr>

	<tr>
		<td>Referencing - Table</td>
		<td><input type='text' name='fk_table' class='form-control' /></td>
	</tr>

	<tr>
		<td>Referencing - Field</td>
		<td><input type='text' name='fk_field' class='form-control' /></td>
	</tr>

	<tr>
		<td>Parent</td>
		<td><input type='text' name='fk_field_pk' class='form-control' /></td>
	</tr>

	<tr>
		<td>Title</td>
		<td><input type='text' name='title' class='form-control' /></td>
	</tr>

	<tr>
		<td>Created - Date</td>
		<td><input type='text' name='created_date' class='form-control' /></td>
	</tr>

	<tr>
		<td>Created - By</td>
		<td><input type='text' name='created_by' class='form-control' /></td>
	</tr>

	<tr>
		<td>Modified - Date</td>
		<td><input type='text' name='modified_date' class='form-control' /></td>
	</tr>

	<tr>
		<td>Modified - By</td>
		<td><input type='text' name='modified_by' class='form-control' /></td>
	</tr>

	<tr>
		<td>Row Source</td>
		<td><input type='text' name='row_source' class='form-control' /></td>
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