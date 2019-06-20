<?php

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$invoice = new Invoice($db);

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=invoice.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
    "id",
    "invoice_number", 
    "job_card_id",
    "date_issued", 
    "date_due", 
    "total_invoiced",
    "invoice_status_id", 
    "created_date", 
    "created_by",
    "modified_date", 
    "modified_by", 
    "row_source",
    "signed_off_by"
), ";");

// fetch the data
$stmt = $invoice->read();

// loop over the rows, outputting them
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) fputcsv($output, $row, ";");

?>