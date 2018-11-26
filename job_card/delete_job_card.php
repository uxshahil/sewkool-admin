<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/job_card.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare job_card object
    $job_card = new Job_Card($db);

    // set job_card id to be deleted
    $job_card->id = $_POST['object_id'];

    // delete job_card
    if($job_card->delete()){
        echo "Job_Card was deleted.";
    }

    // if unable to delete the job_card
    else {
        echo "Unable to delete job_card.";
    }
}
?>