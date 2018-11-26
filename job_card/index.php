<?php
// core.php holds pagination variables
include_once '../config/core.php';

// include database and object files
include_once '../config/database.php';
include_once '../objects/job_card.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$job_card = new Job_Card($db);

// set navigation
$nav_title = "Job_Card";

// set page header
$page_title = "Read Job_Card";
include_once "layout_header.php";

// query job_card
$stmt = $job_card->readAll($from_record_num, $records_per_page);

// specify the page where paging is used
$page_url = "index.php?";

// count total rows - used for pagination
$total_rows=$job_card->countAll();

// read_template.php controls how the user list will be rendered
include_once "read_template.php";

// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>