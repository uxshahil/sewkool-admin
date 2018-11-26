<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
 
        <div class="navbar-header">
            <!-- to enable navigation dropdown when viewed in mobile device -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
 
            <!-- Change "Your Site" to your site name *EDIT* --> 
            <a class="navbar-brand" href="<?php echo $home_url; ?>">SewKool - App</a>
        </div>
 
        <div class="navbar-collapse collapse">
            
            <?php
            // check if users / customer was logged in
            // if user was logged in, show "Edit Profile", "Orders" and "Logout" options
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Customer'){
                ?>

                    <ul class="nav navbar-nav">
                        <!-- link to the "Home" page, highlight if current page is index.php -->
                        <li <?php echo $nav_title=="Index" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url; ?>">Home</a>
                        </li>

                        <!-- highlight if $nav_title has 'Job_Card' word. -->
                        <li <?php echo $nav_title=="Job_Card" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card_process/index.php" class="dropdown-toggle">Job_Card</a>
                        </li>

                        <!-- highlight if $nav_title has 'Business' word. -->
                        <li <?php echo $nav_title=="Business" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>business/index.php" class="dropdown-toggle">Business</a>
                        </li>   

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li <?php echo $page_title=="Edit Profile" ? "class='active'" : ""; ?>>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                &nbsp;&nbsp;<?php echo $_SESSION['first_name']; ?>
                                &nbsp;&nbsp;<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php
            }else if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Admin'){
                ?>
                    <ul class="nav navbar-nav">
                        <!-- link to the "Home" page, highlight if current page is index.php -->
                        <li <?php echo $nav_title=="Index" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>index.php">Home</a>
                        </li>

                        <!-- highlight if $nav_title has 'Job_Card' word. -->
                        <li <?php echo $nav_title=="Job_Card" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card_process/index.php" class="dropdown-toggle">Job_Card</a>
                        </li>

                        <!-- highlight if $nav_title has 'Business' word. -->
                        <li <?php echo $nav_title=="Business" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>business/index.php" class="dropdown-toggle">Business</a>
                        </li>   

                        <!-- highlight if $nav_title has 'Receipt' word. -->
                        <li <?php echo $nav_title=="Receipt" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>receipt/index.php" class="dropdown-toggle">Receipt</a>
                        </li>   

                        <!-- highlight if $nav_title has 'Job_Card' word. -->
                        <li <?php echo $nav_title=="Admin" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>admin/index.php" class="dropdown-toggle">Admin</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                &nbsp;&nbsp;<?php echo $_SESSION['first_name']; ?>
                                &nbsp;&nbsp;<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php
            }
            // if user was not logged in, show the "login" and "register" options
            else{
            ?>
            <ul class="nav navbar-nav">
                <!-- link to the "Home" page, highlight if current page is index.php -->
                <li <?php echo $nav_title=="Index" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>">Home</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li <?php echo $page_title=="Login" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>login">
                        <span class="glyphicon glyphicon-log-in"></span> Log In
                    </a>
                </li>
            
                <li <?php echo $page_title=="Register" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>register">
                        <span class="glyphicon glyphicon-check"></span> Register
                    </a>
                </li>
            </ul>
            <?php
            }
            ?>
             
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->