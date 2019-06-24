<?php
// core.php holds pagination variables
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php';

// inculde database and object files
include_once $root_dir .'config/database.php';
include_once $root_dir .'objects/receipt.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$receipt = new Receipt($db);

// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';

// set navigation
$nav_title = "Receipt";

$page_title = "You searched for \"{$search_term}\"";
include_once "layout_header.php";

// query receipt
$stmt = $receipt->search($search_term, $from_record_num, $records_per_page);

// specify the page where paging is used
$page_url = "search.php?s={$search_term}&";

// count total rows - used for pagination
$total_rows=$receipt->countAll_BySearch($search_term);

// read_template.php controls how the receipt list will be rendered
include_once "read_template.php";

// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>