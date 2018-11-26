<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/line_item_temp.php';
include_once '../objects/job_card.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$line_item_temp = new Line_Item_Temp($db);
$job_card = new Job_Card($db);

$page_title = "Create Job_Card_Process";

if(!isset($_SESSION['job_card'])){
    $_SESSION['job_card']=array();
}

// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set line_item property values
    
    $line_item_temp->job_card_id = 999999;
	$line_item_temp->item = $_POST['item'];
	$line_item_temp->item_qty = $_POST['item_qty'];
	$line_item_temp->item_qty_verified = $_POST['item_qty_verified'];
	$line_item_temp->item_qty_info = $_POST['item_qty_info'];

    $image=!empty($_FILES["artwork_logo"]["name"])
        ? sha1_file($_FILES['artwork_logo']['tmp_name']) . "-" . basename($_FILES["artwork_logo"]["name"]) : "";
    $line_item_temp->artwork_logo = $image;

	$line_item_temp->artwork_position = $_POST['artwork_position'];
	$line_item_temp->artwork_color = $_POST['artwork_color'];
	$line_item_temp->other_info = $_POST['other_info'];
	$line_item_temp->price_artwork = $_POST['price_artwork'];
    $line_item_temp->price_setup = $_POST['price_setup'];
    $line_item_temp->price_embroidery = $_POST['price_embroidery'];
	$line_item_temp->fulfilled = $_POST['fulfilled'];

    // create the line_item
    if($line_item_temp->create()){
        echo "<div class='alert alert-success'>Line_Item was created.</div>";

        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $line_item_temp->uploadPhoto();
        header('Location: create_job_card.php?action=line_item_added');
    }

    // if unable to create the line_item, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create line_item.</div>";
        header('Location: create_job_card.php?action=error');
    }
}


?>