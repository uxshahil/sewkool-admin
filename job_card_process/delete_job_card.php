<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/job_card.php';
    include_once '../objects/invoice.php';
    include_once '../objects/line_item.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to objects
    $job_card = new Job_Card($db);
    $invoice = new Invoice($db);
    $line_item = new Line_Item($db);

    // set Job Card id to be deleted
    $job_card->id = $_POST['object_id'];
    $invoice->job_card_id = $_POST['object_id'];
    $line_item->job_card_id = $_POST['object_id'];

    $page_title = "Delete Job_Card_Process";

    // delete Job Card
    if($job_card->delete()){

        // delete Job Card
        if($invoice->deleteJobCard()){

            // delete Job Card
            if($line_item->deleteJobCard()){
                echo "Job_Card_Process was deleted.";
            }

            // if unable to delete the Job Card
            else {
                echo "Unable to delete Job Card line items.";
            }
        }

        // if unable to delete the Job Card
        else {
            echo "Unable to delete Job Card invoice.";
        }
    }

    // if unable to delete the Job Card
    else {
        echo "Unable to delete Job Card";
    }
}
?>