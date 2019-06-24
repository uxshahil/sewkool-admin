<?php
/*
	Sample Processing of Forgot password form via ajax
	Page: extra-register.html
*/

# Response Data Array
$resp = array();


// Fields Submitted
$username = $_POST["username"];
$password = $_POST["password"];


// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
$resp['submitted_data'] = $_POST;

// core configuration
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php';

// include classes
include_once "../config/database.php";
include_once "../objects/user.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$user = new User($db);

// check if email and password are in the database
$user->contact_email=$_POST['username'];

// check if email exists, also get user details using this emailExists() method
$email_exists = $user->emailExists();

// Login success or invalid login data [success|invalid]
// Validate login
$login_status = 'invalid';

if 
(
    $email_exists && 
    password_verify($_POST['password'], $user->password) && 
    $user->status==1)
{
    $login_status = 'success';
}

$resp['login_status'] = $login_status;

// Login Success URL
if($login_status == 'success')
{
	// If you validate the user you may set the user cookies/sessions here
		#setcookie("logged_in", "user_id");
        #$_SESSION["logged_user"] = "user_id";
        
    // if it is, set the session value to true
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user->id;
    $_SESSION['access_level'] = $user->access_level;
    $_SESSION['first_name'] = htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') ;
    $_SESSION['last_name'] = $user->last_name;

    // if access level is 'Admin', redirect to admin section
    if($user->access_level=='Admin')
    {
        // Set the redirect url after successful login
	    $resp['redirect_url'] = $home_url . 'index.php?action=login_success';
    }

    // else, redirect only to 'User' section
    else
    {
        // Set the redirect url after successful login
	    $resp['redirect_url'] = $home_url . 'index.php?action=login_success';
    }
}

echo json_encode($resp);