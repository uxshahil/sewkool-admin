<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo $page_title; ?></title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="../libs/vendor/css/bootstrap-3.3.7.min.css" media="screen"/>
  
    <!-- our custom CSS -->
    <link rel="stylesheet" href="../libs/css/custom.css" />

    <!-- javascript function to delete any cookies before loading page -->
    <script class="javascript">
        function deleteAllCookies() {
            var cookies = document.cookie.split(";");

            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                var eqPos = cookie.indexOf("=");
                var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
            }
        }
    </script>

    <!-- link to barcode js library -->
    <script src="../libs/vendor/js/JsBarcode.all.min.js"></script>
  
</head>
<body>

    <?php include '../navigation.php'; ?>
 
    <!-- container -->
    <div class="container">
 
        <?php
        // show page header
        echo "<div class='page-header'>
                <h1>{$page_title}</h1>
            </div>";
        ?>