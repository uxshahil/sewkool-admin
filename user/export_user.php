<?php

// inlcude database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$user = new User($db);

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=user.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array(
    "id",
    "first_name", 
    "last_name", 
    "contact_email",
    "contact_number", 
    "address",
    "password", 
    "access_level", 
    "access_code",
    "status", 
    "image", 
    "created_date", 
    "created_by",
    "modified_date", 
    "modified_by", 
    "row_source"
), ";");

// fetch the data
$stmt = $user->read();

// loop over the rows, outputting them
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) fputcsv($output, $row, ";");

?>