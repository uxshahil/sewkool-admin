<?php
// core.php holds pagination variables
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php';

// include database and object files
include_once $root_dir .'config/database.php';
include_once $root_dir .'objects/job_card.php';
include_once $root_dir .'objects/status.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$job_card = new Job_Card($db);
$status = new Status($db);

// set navigation
$nav_title = "Job Card";

// set page header
$page_title = "Read Job Card";

// include login checker
$require_login=true;
include_once $root_dir ."login_checker.php";

// include page header HTML
include_once "layout_header.php";

// specify the page where paging is used
$page_url = "index.php?";

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

$job_card_phase_id = isset($_GET['job_card_phase']) ? $_GET['job_card_phase'] : "";
$job_card_status_id = isset($_GET['job_card_status_id']) ? $_GET['job_card_status_id'] : "";

if($action=='filter_phase'){
    // query Job Card
    $stmt = $job_card->readAllPhase($from_record_num, $records_per_page, $job_card_phase_id);
    $total_rows=$job_card->countAllPhase($job_card_phase_id);
}

else if($action=='filter_status'){
    // query Job Card
    $stmt = $job_card->readAllStatus($from_record_num, $records_per_page, $job_card_status_id);
    $total_rows=$job_card->countAllStatus($job_card_status_id);
} 

else if($action=='no_void'){
    // query Job Card
    $stmt = $job_card->readAllNoVoid($from_record_num, $records_per_page);
    $total_rows=$job_card->countAllNoVoid();
}

else if($action=='no_invoiced'){
    // query Job Card
    $stmt = $job_card->readAllNoInvoiced($from_record_num, $records_per_page);
    $total_rows=$job_card->countAllNoInvoiced();
}

else if($action=='no_void_no_invoiced'){
    // query Job Card
    $stmt = $job_card->readAllNoVoidNoInvoiced($from_record_num, $records_per_page);
    $total_rows=$job_card->countAllNoVoidNoInvoiced();
}

else if($action=='no_filter'){
    // query Job Card
    $stmt = $job_card->readAll($from_record_num, $records_per_page);
    $total_rows=$job_card->countAll();
}

else {
    // query Job Card
    $stmt = $job_card->readAllNoVoidNoInvoiced($from_record_num, $records_per_page);
    $total_rows=$job_card->countAllNoVoidNoInvoiced();
}

// read_template.php controls how the user list will be rendered
include_once "read_template.php";

// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>