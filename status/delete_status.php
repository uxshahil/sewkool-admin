<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once $root_dir .'config/database.php';
    include_once $root_dir .'objects/status.php';

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