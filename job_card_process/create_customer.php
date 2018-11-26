<?php

// core.php holds pagination variables: includes session_start();
include_once '../config/core.php'; 

// inlcude dtaabase and object files
include_once '../config/database.php';
include_once '../objects/business.php';

//get databse connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$business = new Business($db);

// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
    
    // set business property values
	$business->name = $_POST['name'];
	$business->description = $_POST['description'];
	$business->head_office = $_POST['head_office'];
	$business->branch_name = $_POST['branch_name'];
	$business->adr_postal = $_POST['adr_postal'];
	$business->adr_location = $_POST['adr_location'];
	$business->contact_primary_name = $_POST['contact_primary_name'];
	$business->contact_primary_number = $_POST['contact_primary_number'];
	$business->contact_primary_email = $_POST['contact_primary_email'];
	$business->contact_secondary_name = $_POST['contact_secondary_name'];
	$business->contact_secondary_number = $_POST['contact_secondary_number'];
	$business->contact_secondary_email = $_POST['contact_secondary_email'];
	$business->contact_business_number = $_POST['contact_business_number'];
	$business->contact_business_email = $_POST['contact_business_email'];
	$business->contact_business_www = $_POST['contact_business_www'];
	$business->contact_business_twitter = $_POST['contact_business_twitter'];
	$business->contact_business_facebook = $_POST['contact_business_facebook'];
	$business->contact_business_instagram = $_POST['contact_business_instagram'];
	$business->contact_business_youtube = $_POST['contact_business_youtube'];

	$image=!empty($_FILES["image"]["name"])
		? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$business->image = $image;
	
	$business->vat = $_POST['vat'];
	$business->company_registration = $_POST['company_registration'];

    // create the business
    if($business->create()){
        echo "<div class='alert alert-success'>Business was created.</div>";

        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
		echo $business->uploadPhoto();
		header('Location: create_job_card.php?action=business_added');
    }

    // if unable to create the business, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create business.</div>";
    }
}


?>