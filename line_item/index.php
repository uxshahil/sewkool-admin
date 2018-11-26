<?php
// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/line_item.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$line_item = new Line_Item($db);

// set navigation
$nav_title = "Line_Item";

// set page header
$page_title = "Read Line_Item";
include_once "layout_header.php";

// query line_item
$stmt = $line_item->readAll($from_record_num, $records_per_page);

// specify the page where paging is used
$page_url = "index.php?";

// count total rows - used for pagination
$total_rows=$line_item->countAll();

// read_template.php controls how the user list will be rendered
include_once "read_template.php";

// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>