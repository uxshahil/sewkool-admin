<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/user.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare user object
    $user = new User($db);

    // set user id to be deleted
    $user->id = $_POST['object_id'];

    // delete user
    if($user->delete()){
        echo "User was deleted.";
    }

    // if unable to delete the user
    else {
        echo "Unable to delete user.";
    }
}
?>