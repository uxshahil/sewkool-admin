<?php

// core configuration
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php';

// set navigation
$nav_title = "Login";
 
// set page title
$page_title = "Login";
 
// include login checker
$require_login=false;
include_once $root_dir .'login_checker.php';
 
// default to false
$access_denied=false;

// if the login form was submitted
if($_POST){
    // include classes
    include_once "config/database.php";
    include_once "objects/user.php";

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // initialize objects
    $user = new User($db);

    // check if email and password are in the database
    $user->contact_email=$_POST['contact_email'];

    // check if email exists, also get user details using this emailExists() method
    $email_exists = $user->emailExists();

    // validate login
    if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1){
    
        // if it is, set the session value to true
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['first_name'] = htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') ;
        $_SESSION['last_name'] = $user->last_name;
    
        // if access level is 'Admin', redirect to admin section
        if($user->access_level=='Admin'){
            header("Location: {$home_url}index.php?action=login_success");
        }
    
        // else, redirect only to 'User' section
        else{
            header("Location: {$home_url}index.php?action=login_success");
        }
    }
    
    // if username does not exist or password is wrong
    else{
        $access_denied=true;
    }
}

// include page header HTML
include_once "layout_head.php";

// get 'action' value in url parameter to display corresponding prompt messages
$action=isset($_GET['action']) ? $_GET['action'] : "";

// tell the user he is not yet logged in
if($action =='not_yet_logged_in'){

    ?><script type='text/javascript'>
        jQuery(document).ready(function($) { 
            toastr.info('Please login'); 
        });
    </script><?php
    
}

// tell the user to login
else if($action=='please_login'){

    ?><script type='text/javascript'>
        jQuery(document).ready(function($) { 
            toastr.info('Please login to access that page.'); 
        });
    </script><?php

}

// tell the user if access denied
if($access_denied){

    ?><script type='text/javascript'>
    jQuery(document).ready(function($) { 
        toastr.info('Access Denied. Your username or password maybe incorrect'); 
    });
    </script><?php

}

?>


<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '';
</script>

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="index.php" class="logo">
				<img src="assets/images/logo@2x.png" width="120" alt="" />
			</a>
			
			<p class="description">Dear user, log in to access the admin area!</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
			</div>
			
			<?php echo "<form class='form-signin' action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post' role='form' id='form_login'>";?>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="Username" autocomplete="off" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Login In
					</button>
				</div>
				
			</form>
			
			
			<div class="login-bottom-links">

                <?php echo "<a href='{$home_url}forgot_password'  class='link'>Forgot your password?</a>" ?>

				<br />
				
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
				
			</div>
			
		</div>
		
	</div>
	
</div>

	<!-- Bottom scripts (common) -->
	<script src="assets/js/gsap/TweenMax.min.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>

	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>

	<!-- Demo Settings 
	<script src="assets/js/neon-demo.js"></script> -->

</body>
</html>