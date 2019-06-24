<?php
// core configuration
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php';
 
// destroy session, it will remove ALL session settings
session_destroy();

// destroy session variables
$_SESSION = [];
  
//redirect to login page
header("Location: {$home_url}login.php");
?>