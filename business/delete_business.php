<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/business.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare business object
    $business = new Business($db);

    // set business id to be deleted
    $business->id = $_POST['object_id'];

    // delete business
    if($business->delete()){
        echo "Business was deleted.";
    }

    // if unable to delete the business
    else {
        echo "Unable to delete business.";
    }
}
?>