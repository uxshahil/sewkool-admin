<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/status.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$job_card = new Job_Card($db);
$status = new Status($db);

$action = isset($_GET['action']) ? $_GET['action'] : "";

// if the form was submitted
if($_POST){

    if($action=='update_status'){
        // set job_card property values
        $job_card->id = $_POST['job_card_id'];
        $job_card->job_card_status_id = $_POST['job_card_status_id'];

        // update the job_card
        if($job_card->updateStatus()){
            header("Location: {$home_url}job_card_process/read_one.php?action=status_updated&id=" . $job_card->id);
        }

        // if unable to update the job_card, tell the user
        else {
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to update job_card status.";
            echo "</div>";
        }
    }
    
    else if($action=='verify_quantity'){
        // set job_card property values
        $job_card->id = $_POST['job_card_id'];
        $job_card->job_card_status_id = $_POST['job_card_status_id'];
        $job_card->qty_verify_customer = $_POST['qty_verify_customer'];
        $job_card->qty_verify_checked = $_POST['qty_verify_checked'];
        $job_card->qty_verify_info = $_POST['qty_verify_info'];

        // update the job_card
        if($job_card->verifyQuantity()){
            header("Location: {$home_url}job_card_process/read_one.php?action=verify_quantity&id=" . $job_card->id);
        }

        // if unable to update the job_card, tell the user
        else {
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to update update quantity.";
            echo "</div>";
        }    
    }
    
    else if($action=='verify_quality'){
        // set job_card property values
        $job_card->id = $_POST['job_card_id'];
        $job_card->job_card_status_id = $_POST['job_card_status_id'];
        $job_card->qty_quality_pass = $_POST['qty_quality_pass'];
        $job_card->qty_quality_not_pass = $_POST['qty_quality_not_pass'];
        $job_card->qty_quality_info = $_POST['qty_quality_info'];

        // update the job_card
        if($job_card->verifyQuality()){
            header("Location: {$home_url}job_card_process/read_one.php?action=verify_quality&id=" . $job_card->id);
        }

        // if unable to update the job_card, tell the user
        else {
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to update update quantity.";
            echo "</div>";
        }        
    }
    
    else if($action=='assign_user'){
        // set job_card property values
        $job_card->id = $_POST['job_card_id'];
        $job_card->job_card_status_id = $_POST['job_card_status_id'];
        $job_card->assigned_to = $_POST['assigned_to'];

        // update the job_card
        if($job_card->assignUser()){
            header("Location: {$home_url}job_card_process/read_one.php?action=assign_user&id=" . $job_card->id);
        }

        // if unable to update the job_card, tell the user
        else {
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to update update quantity.";
            echo "</div>";
        }            
    }
        
}
?>

