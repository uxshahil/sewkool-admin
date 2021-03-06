<?php
// show error reporting
error_reporting(E_ALL);

// start php session
session_start();

// set your default time-zone
date_default_timezone_set('Africa/Johannesburg');

$root_dir = '/Users/admin/Sites/tuts/sewkool-admin-master/';
//$root_dir = '/Users/admin/Sites/tuts/sewkool-admin-master/'; local
//$root_dir = '/var/www/themidastouch.co.za/public_html/sewkool-admin/'; dev / uat / live

// home page url *EDIT*
$home_url="http://localhost/tuts/sewkool-admin-master/"; // local http
//$home_url="http://localhost/tuts/sewkool-admin-master/"; // local http
//$home_url="https://dev.themidastouch.co.za/sewkool-admin/"; // dev https
//$home_url="https://uat.themidastouch.co.za/sewkool-admin/"; // uat https
//$home_url="https://themidastouch.co.za/sewkool-admin/"; // live https

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 1000;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>