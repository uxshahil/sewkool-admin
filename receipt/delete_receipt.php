<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/receipt.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare receipt object
    $receipt = new Receipt($db);

    // set receipt id to be deleted
    $receipt->id = $_POST['object_id'];

    // delete receipt
    if($receipt->delete()){
        echo "Receipt was deleted.";
    }

    // if unable to delete the receipt
    else {
        echo "Unable to delete receipt.";
    }
}
?>