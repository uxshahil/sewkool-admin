<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$invoice = new Invoice($db);

$action = isset($_GET['action']) ? $_GET['action'] : "";

// if the form was submitted
if($_POST){

    if($action=='sign_off_invoice'){
        // set Job Card property values
        $invoice->id = $_POST['invoice_id'];
        $invoice->date_issued = $_POST['date_issued'];
        $invoice->signed_off_by = $_POST['signed_off_by'];

        // update the Job Card
        if($invoice->signOffInvoice()){
            header("Location: {$home_url}invoice/read_one.php?action=sign_off_invoice&id=" . $invoice->id);
        }

        // if unable to update the Job Card, tell the user
        else {
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to sign off invoice.";
            echo "</div>";
        }
    }

}