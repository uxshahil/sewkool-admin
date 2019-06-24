<?php

// inlcude database and object files
include_once $root_dir .'config/database.php';
include_once $root_dir .'objects/receipt.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$receipt = new Receipt($db);

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=receipt.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
    "id",
    "client_business_id", 
    "date_receipted", 
    "amount_receipted",
    "payment_method_id", 
    "payment_reference", 
    "created_date", 
    "created_by",
    "modified_date", 
    "modified_by", 
    "row_source"
), ";");

// fetch the data
$stmt = $receipt->read();

// loop over the rows, outputting them
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) fputcsv($output, $row, ";");

?>