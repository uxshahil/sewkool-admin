<?php
// core.php holds pagination variables
include_once 'config/core.php';

// include database and object files
include_once 'config/database.php';
include_once 'objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$user = new User($db);

// set ID property of user to be read
$user->id = $_SESSION['user_id'];

// read the details of user to be read
$user->readOne();
?>