<?php
// core configuration
include_once "config/core.php";

// include database and object files
include_once 'config/database.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

// set navigation
$nav_title = "Home";
 
// set page title
$page_title="Home";
 
// include login checker
$require_login=true;
include_once "login_checker.php";
 
// include page header HTML
include_once 'layout_head.php';

// specify the page where paging is used
$page_url = "index.php?";
 
// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// if login was successful
if($action=='login_success'){
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-info'>";
            echo "<strong>Hi " . $_SESSION['first_name'] . ", welcome back!</strong>";
        echo "</div>";
    echo "</div>";
}

// if user is already logged in, shown when user tries to access the login page
else if($action=='already_logged_in'){
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-info'>";
            echo "<strong>You are already logged in.</strong>";
        echo "</div>";
    echo "</div>";
}

// layout_footer.php holds our javascript and closing html tags
include_once "layout_foot.php";
?>