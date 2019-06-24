<?php
/*
	Processing of Forgot password form via ajax
	Page: forgotpassword.php
*/

// core configuration
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php';

// include classes
include_once "../config/database.php";
include_once $root_dir .'objects/user.php';
include_once "../libs/php/utils.php";

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);
$utils = new Utils();
 
// check if username and password are in the database
$user->contact_email=$_POST['email'];

// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
# Response Data Array
$resp = array();

$resp['email'] = $_POST["email"];

if($user->emailExists()){

    // update access code for user
    $access_code=$utils->getToken();

    $user->access_code=$access_code;
    if($user->updateAccessCode())
    {

        // send reset link
        $body="Hi there.<br /><br />";
        $body.="Please click the following link to reset your password: {$home_url}reset_password?access_code={$access_code}";
        $subject="Reset Password";
        $send_to_email=$_POST['email'];

        if($utils->sendEmailViaPhpMail($send_to_email, $subject, $body))
        {
            $resp['status'] = 0;
            $resp['message'] = 'Success: Reset email sent.';
        }

        // message if unable to send email for password reset link
        else
        {  
            $resp['status'] = 1; 
            $resp['message'] = 'System Error: Unable to generate reset link.';
        }
    }

    // message if unable to update access code
    else 
    { 
        $resp['status'] = 2; 
        $resp['message'] = 'System Error: Unable to update access code.';
    }

}

// message if email does not exist
else
{ 
    $resp['status'] = 3; 
    $resp['message'] = 'System Error: Unable to find email';
}

echo json_encode($resp);