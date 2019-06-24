<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Admin Dashboard" />
	<meta name="author" content="Midas Touch Holdings Pty Ltd" />

	<link rel="icon" href="../assets/images/favicon.ico">

    <!-- set the page title, for seo purposes too -->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Store Front"; ?></title>
 
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="libs/vendor/css/bootstrap-3.3.7.min.css" media="screen"/> -->

	<link rel="stylesheet" href="../assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="../assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="../libs/vendor/css/bootstrap-3.3.7.min.css" media="screen"/>
	<link rel="stylesheet" href="../assets/css/neon-core.css">
	<link rel="stylesheet" href="../assets/css/neon-theme.css">
	<link rel="stylesheet" href="../assets/css/neon-forms.css">
	<link rel="stylesheet" href="../assets/css/custom.css">

    <!-- <script src="../assets/js/jquery-1.11.3.min.js"></script> -->
    <script src="../libs/vendor/js/jquery-3.2.1.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <!-- javascript function to delete any cookies before loading page -->
    <script class="javascript">
        function deleteAllCookies() 
        {
            var cookies = document.cookie.split(";");

            for (var i = 0; i < cookies.length; i++) 
            {
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