<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/status.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$status = new Status($db);

// set navigation
$nav_title = "Status";

// set page headers
$page_title = "Create Status";
include_once "layout_header.php";

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Statuss</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set status property values
	$status->fk_table = $_POST['fk_table'];
	$status->fk_field = $_POST['fk_field'];
	$status->parent_id = $_POST['parent_id'];
	$status->title = $_POST['title'];
	$status->description = $_POST['description'];

    // create the status
    if($status->create()){
        echo "<div class='alert alert-success'>Status was created.</div>";
    }

    // if unable to create the status, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create status.</div>";
    }
}
?>

<!-- HTML form for creating a status -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

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
		<td><input type='text' name='parent_id' class='form-control' /></td>
	</tr>

	<tr>
		<td>Title</td>
		<td><input type='text' name='title' class='form-control' /></td>
	</tr>

	<tr>
		<td>Description</td>
		<td><input type='text' name='description' class='form-control' /></td>
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