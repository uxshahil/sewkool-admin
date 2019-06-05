<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/status.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare status object
    $status = new Status($db);

    // set status id to be deleted
    $status->id = $_POST['object_id'];

    // delete status
    if($status->delete()){
        echo "Status was deleted.";
    }

    // if unable to delete the status
    else {
        echo "Unable to delete status.";
    }
}
?>