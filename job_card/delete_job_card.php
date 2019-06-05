<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/job_card.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare Job Card object
    $job_card = new Job_Card($db);

    // set Job Card id to be deleted
    $job_card->id = $_POST['object_id'];

    // delete Job Card
    if($job_card->delete()){
        echo "Job Card was deleted.";
    }

    // if unable to delete the Job Card
    else {
        echo "Unable to delete job card.";
    }
}
?>