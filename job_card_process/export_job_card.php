<?php

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$job_card = new Job_Card($db);

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=job_card.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
    "id",
    "client_business_id", 
    "customer_business_id",
    "job_card_status_id", 
    "created_date", 
    "created_by",
    "modified_date", 
    "modified_by", 
    "row_source",
    "client_invoice_number", 
    "skip_artwork", 
    "qty_verify_customer",
    "qty_verify_checked", 
    "qty_verify_info", 
    "qty_quality_pass",
    "qty_quality_not_pass", 
    "qty_quality_info",
    "assigned_to"
), ";");

// fetch the data
$stmt = $job_card->read();

// loop over the rows, outputting them
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) fputcsv($output, $row, ";");

?>