<?php

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/business.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$business = new business($db);

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=business.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
    "id",
    "name", 
    "description",
    "adr_postal", 
    "adr_location", 
    "contact_primary_name",
    "contact_primary_number", 
    "contact_primary_email", 
    "contact_secondary_name",
    "contact_secondary_number", 
    "contact_secondary_email", 
    "contact_business_number",
    "contact_business_email", 
    "contact_business_www", 
    "contact_business_twitter",
    "contact_business_facebook", 
    "contact_business_instagram",
    "contact_business_youtube",
    "created_date", 
    "created_by", 
    "modified_date",
    "modified_by", 
    "row_source",
    "image",
    "vat",
    "company_registration",
    "account_status_id", 
    "private_client"
), ";");

// fetch the data
$stmt = $business->read();

// loop over the rows, outputting them
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) fputcsv($output, $row, ";");

?>