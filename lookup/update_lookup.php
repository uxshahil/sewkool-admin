<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/lookup.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$lookup = new Lookup($db);

// set ID property of lookup to be edited
$lookup->id = $id;

// read the details of lookup to be edited
$lookup->readOne();

// set navigation
$nav_title = "Lookup";

// set page header
$page_title = "Update Lookup";
include_once "layout_header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Read Lookup</a>";
    echo "</div>";

?>

<?php
// if the form was submitted
if($_POST){

    // set lookup property values
	$lookup->collection = $_POST['collection'];
	$lookup->title = $_POST['title'];

// update the lookup
    if($lookup->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Lookup was updated.";
        echo "</div>";
    }

// if unable to update the lookup, tell the user
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to udpate lookup.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered box'>

		<tr>
			<td>Collection</td>
			<td><input type='text' name='collection' value='<?php echo $lookup->collection; ?>' class='form-control' /></td>
		</tr>

		<tr>
			<td>Title</td>
			<td><input type='text' name='title' value='<?php echo $lookup->title; ?>' class='form-control' /></td>
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