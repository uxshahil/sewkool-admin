<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/line_item_temp.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare line_item_temp object
    $line_item_temp = new Line_Item_Temp($db);

    // set line_item_temp id to be deleted
    $line_item_temp->id = $_POST['object_id'];

    // delete line_item_temp
    if($line_item_temp->delete()){
        echo "line_item_temp was deleted.";
    }

    // if unable to delete the line_item_temp
    else {
        echo "Unable to delete line_item_temp.";
    }
}
?>