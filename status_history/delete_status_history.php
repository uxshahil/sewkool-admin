<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/status_history.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare status_history object
    $status_history = new Status_History($db);

    // set status_history id to be deleted
    $status_history->id = $_POST['object_id'];

    // delete status_history
    if($status_history->delete()){
        echo "Status_History was deleted.";
    }

    // if unable to delete the status_history
    else {
        echo "Unable to delete status_history.";
    }
}
?>