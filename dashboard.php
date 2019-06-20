<?php
// core configuration
include_once "config/core.php";

// set navigation
$nav_title = "Dashboard";
 
// set page title
$page_title = "Dashboard";
 
// include page header HTML
include_once 'layout_head.php';
 
//include_once 'report/dashboard.php';
include_once 'report/dashboard-deadline.php';
 
// footer HTML and JavaScript codes
include 'layout_foot.php';
?>