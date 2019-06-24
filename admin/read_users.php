<?php
// core configuration
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php';
 
// check if logged in as admin
include_once $root_dir .'login_checker.php';
 
// include classes
include_once $root_dir .'config/database.php';
include_once $root_dir .'objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new User($db);
 
// set page title
$page_title = "Users";
$nav_title = "Users";
 
// include page header HTML
include_once "layout_head.php";
 
echo "<div class='col-md-12'>";
 
    // read all users from the database
    $stmt = $user->readAll($from_record_num, $records_per_page);
 
    // count retrieved users
    $num = $stmt->rowCount();
 
    // to identify page for paging
    $page_url="read_users.php?";
 
    // include products table HTML template
    include_once "read_users_template.php";
 
echo "</div>";
 
// include page footer HTML
include_once "layout_foot.php";
?>