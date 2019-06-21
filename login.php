<?php
// core configuration
include_once "config/core.php";

// set navigation
$nav_title = "Login";
 
// set page title
$page_title = "Login";
 
// include login checker
$require_login=false;
include_once "login_checker.php";

// include page header HTML
include_once "layout_head.php";

// get 'action' value in url parameter to display corresponding prompt messages
$action=isset($_GET['action']) ? $_GET['action'] : "";

// tell the user he is not yet logged in
if($action =='not_yet_logged_in'){

    ?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) 
            { 
                toastr.info('Please login'); 
            });
        </script>
    <?php
    
}

// tell the user to login
else if($action=='please_login'){

    ?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) 
            { 
                toastr.info('Please login to access that page.'); 
            });
        </script>
    <?php

}
?>

<!-- 1. body must include page-body class #neon-theme -->
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '<?php echo $home_url ?>';
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
				<p>Your <strong>username </strong>or <strong>password </strong>may be incorrect.</p>
            </div>
            
            <form method="post" role="form" id="form_login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="username" id="username" placeholder="Email" autocomplete="off" />
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
    <script src="assets/js/toastr.js"></script>
    <script src="assets/js/neon-api.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/neon-login.js"></script>

    <!-- JavaScripts initializations and stuff -->
    <script src="assets/js/neon-custom.js"></script>

    <!-- Demo Settings 
    <script src="assets/js/neon-demo.js"></script> -->

</body>
</html>