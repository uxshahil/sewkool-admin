<?php
// show error reporting
error_reporting(E_ALL);

// start php session
session_start();

// set your default time-zone
date_default_timezone_set('Africa/Johannesburg');

// home page url *EDIT*
//$home_url="https://dev.themidastouch.co.za/sewkool-admin/"; // dev https
//$home_url="https://uat.themidastouch.co.za/sewkool-admin/"; // uat https
//$home_url="https://themidastouch.co.za/sewkool-admin/"; // live https

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 25;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>