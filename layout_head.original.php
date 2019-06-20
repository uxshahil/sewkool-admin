<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Dashboard" />
    <meta name="author" content="Midas Touch Holdings Pty Ltd" />
    
    <link rel="icon" href="assets/images/favicon.ico">
 
    <!-- set the page title, for seo purposes too -->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Store Front"; ?></title>
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="libs/vendor/css/bootstrap-3.3.7.min.css" media="screen"/>
 
    <!-- admin custom CSS -->
    <link href="<?php echo $home_url . "libs/css/customer.css" ?>" rel="stylesheet" />
    <link href="<?php echo $home_url . "libs/css/custom.css" ?>" rel="stylesheet" />
 
</head>
<body>
 
    <!-- include the navigation bar -->
    <?php include_once 'navigation.php'; ?>
 
    <!-- container -->
    <div class="container">
 
        <?php
        // if given page title is 'Login', do not display the title
        if($page_title!="Login"){
        ?>
        
        <div class="page-header">
            <h1><?php echo isset($page_title) ? $page_title : "The Code of a Ninja"; ?></h1>
        </div>
        
        <?php
        }
        ?>