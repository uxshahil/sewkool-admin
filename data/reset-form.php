<?php
/*
	Processing of Reset password form via ajax
	Page: reset_password.php
*/

// core configuration
include_once "../config/core.php";

// include classes
include_once "../config/database.php";
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);


// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
# Response Data Array
$resp = array();

$resp['access_code'] = $_GET["access_code"];


// get given access code
$access_code=isset($_GET['access_code']) ? $_GET['access_code'] : die("Access code not found.");

// check if access code exists
$user->access_code = $access_code;

if( !$user->accessCodeExists() )
{
    $resp['status'] = 1;
    $resp['message'] = 'System Error: Access code not found.';
}

else
{

    // set values to object properties
    $user->password=$_POST['password'];

    // reset password
    if( $user->updatePassword() )
    {
        $resp['status'] = 0;
        $resp['message'] = 'Success: Password was reset.';
    }

    else
    {
        $resp['status'] = 2;
        $resp['message'] = 'System Error: Unable to reset password.';
    }
}


echo json_encode($resp);