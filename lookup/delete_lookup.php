<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/lookup.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare lookup object
    $lookup = new Lookup($db);

    // set lookup id to be deleted
    $lookup->id = $_POST['object_id'];

    // delete lookup
    if($lookup->delete()){
        echo "Lookup was deleted.";
    }

    // if unable to delete the lookup
    else {
        echo "Unable to delete lookup.";
    }
}
?>