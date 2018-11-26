<?php

// core.php holds pagination variables
include_once '../config/core.php';

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/lookup.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$lookup = new Lookup($db);

// set navigation
$nav_title = "Lookup";

// set page headers
$page_title = "Create Lookup";
include_once "layout_header.php";

echo "<div class ='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Lookups</a>";
echo "</div>";
?>

<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set lookup property values
	$lookup->collection = $_POST['collection'];
	$lookup->title = $_POST['title'];

    // create the lookup
    if($lookup->create()){
        echo "<div class='alert alert-success'>Lookup was created.</div>";
    }

    // if unable to create the lookup, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create lookup.</div>";
    }
}
?>

<!-- HTML form for creating a lookup -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered box'>

	<tr>
		<td>Collection</td>
		<td><input type='text' name='collection' class='form-control' /></td>
	</tr>

	<tr>
		<td>Title</td>
		<td><input type='text' name='title' class='form-control' /></td>
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