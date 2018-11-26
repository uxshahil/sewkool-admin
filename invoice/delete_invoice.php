<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/invoice.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare invoice object
    $invoice = new Invoice($db);

    // set invoice id to be deleted
    $invoice->id = $_POST['object_id'];

    // delete invoice
    if($invoice->delete()){
        echo "Invoice was deleted.";
    }

    // if unable to delete the invoice
    else {
        echo "Unable to delete invoice.";
    }
}
?>