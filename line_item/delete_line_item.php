<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/line_item.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare line_item object
    $line_item = new Line_Item($db);

    // set line_item id to be deleted
    $line_item->id = $_POST['object_id'];

    // delete line_item
    if($line_item->delete()){
        echo "Line_Item was deleted.";
    }

    // if unable to delete the line_item
    else {
        echo "Unable to delete line_item.";
    }
}
?>