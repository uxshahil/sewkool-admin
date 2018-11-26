<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';
include_once '../objects/status.php';
include_once '../objects/business.php';
include_once '../objects/invoice.php';
include_once '../objects/line_item_temp.php';
include_once '../objects/line_item.php';
include_once '../objects/status_history.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$job_card = new Job_Card($db);
$status = new Status($db);
$business = new Business($db);
$invoice = new Invoice($db);
$line_item_temp = new Line_Item_Temp($db);
$line_item = new Line_Item($db);
$status_history = new Status_History($db);

$page_title = "Create Job_Card_Process";

// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // create job card
        // set job_card property values
        $job_card->client_business_id = $_POST['client_business_id'];
        $job_card->customer_business_id = $_POST['customer_business_id'];
        $job_card->job_card_status_id = $_POST['job_card_status_id'];

            // initiate job_card creation or display error upon failure
            if ($job_card->create()){}else{echo "<script>alert('job_card failed')</script>"; header('Location: create_job_card.php?action=job_card_error');}

        // retrieve most recent id from Job_card    
        $job_card_index = $job_card->getIndex();
        $job_card->id = $job_card_index;
            
            // initiate tracking of job_card status or display error upon failure
            if ($status_history->trackJobCardStatus($job_card_index)){}else{echo "<script>alert('job_card_status failed')</script>"; header('Location: create_job_card.php?action=job_card_error');}

    // create invoice
        // set invoice property values
        $invoice->invoice_number = $job_card_index;
        $invoice->job_card_id = $job_card_index;
        $invoice->total_invoiced = (($_POST['total_invoiced'] != "") ?  $_POST['total_invoiced'] : 0 );
        $invoice->invoice_status_id = 27;
        $invoice->date_due = $_POST['date_due'];

            // initiate invoice creation or display error upon failure
            if ($invoice->createJobCardInvoice()){}else{echo "<script>alert('job_card_invoice failed')</script>"; header('Location: create_job_card.php?action=job_card_error');}

        $invoice_index = $invoice->getIndex();

            // initiate tracking of job_card status or display error upon failure
            if ($status_history->trackInvoiceStatus($invoice_index)){}else{echo "<script>alert('job_card_status failed')</script>"; header('Location: create_job_card.php?action=job_card_error');}
    
    // create line items
        // copy data from line_item_temp to line_item
        if ($line_item_temp->commitTempData()){}else{echo "<script>alert('line_item_temp copy data to line_item failed')</script>"; header('Location: create_job_card.php?action=job_card_error');}

        // delete data from line_item_temp
        if ($line_item_temp->purgeTempData()){}else{echo "<script>alert('delete all line_item_temp data failed')</script>"; header('Location: create_job_card.php?action=job_card_error');}

        // set line_item job_card_id to current job_card_index
        $line_item->job_card_id = $job_card_index;

            // update line_item_temp temporary job_card_id to current job_card_index
            if ($line_item->updateJobCardID()){}else{echo "<script>alert('updating line_item job_card_id failed')</script>"; header('Location: create_job_card.php?action=job_card_error');}

    // update account status
        $business->id = $job_card->client_business_id;
        $business->setAccountStatus();

    // redirect to create job card
    header('Location: create_job_card.php?action=job_card_added');

}

?>