<?php
// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/status_history.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$status_history = new Status_History($db);

// set navigation
$nav_title = "Status_History";

// set page header
$page_title = "Read Status_History";
include_once "layout_header.php";

// query status_history
$stmt = $status_history->readAll($from_record_num, $records_per_page);

// specify the page where paging is used
$page_url = "index.php?";

// count total rows - used for pagination
$total_rows=$status_history->countAll();

// read_template.php controls how the user list will be rendered
include_once "read_template.php";

// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>