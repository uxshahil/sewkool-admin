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
            <a class="navbar-brand" href="<?php echo $home_url; ?>job_card_process/">SewKool - App</a>
        </div>
 
        <div class="navbar-collapse collapse">
            
            <?php
            // check if users / User was logged in
            // if user was logged in, show "Edit Profile", "Orders" and "Logout" options
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='User'){
                ?>

                    <ul class="nav navbar-nav">
                        <!-- link to the "Home" page, highlight if current page is index.php -->
                        <li <?php echo $nav_title=="Home" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card_process/index.php">Home</a>
                        </li>

                        <!-- highlight if $nav_title has 'Job Card' word. -->
                        <li <?php echo $nav_title=="Job Card" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Job Card</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>job_card_process/create_job_card.php" class="dropdown-toggle">Create Job Card</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/index.php" class="dropdown-toggle">Read / Update Job Card</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/verify_quantity.php" class="dropdown-toggle">Verify Quantity</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/assign_user.php" class="dropdown-toggle">Assign User to Job Card</a></li>
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Invoice' word. -->
                        <li <?php echo $nav_title=="Invoice" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Invoice</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>invoice/index.php" class="dropdown-toggle">Read / Update Invoice</a></li>
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Business' word. -->
                        <li <?php echo $nav_title=="Business" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Business</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>business/create_business.php" class="dropdown-toggle">Create Business</a></li>
                                <li><a href="<?php echo $home_url;?>business/index.php" class="dropdown-toggle">Read / Update Business</a></li>
                            </ul>
                        </li>   

                        <!-- highlight if $nav_title has 'Receipt' word. -->
                        <li <?php echo $nav_title=="Receipt" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Receipt</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>receipt/create_receipt.php" class="dropdown-toggle">Create Receipt</a></li>
                                <li><a href="<?php echo $home_url;?>receipt/index.php" class="dropdown-toggle">Read / Update Receipt</a></li>
                            </ul>
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
                        <li <?php echo $nav_title=="Home" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card_process/index.php" class="dropdown-toggle">Home</a>
                        </li>

                        <!-- highlight if $nav_title has 'Job Card' word. -->
                        <li <?php echo $nav_title=="Job Card" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Job Card</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>job_card_process/create_job_card.php" class="dropdown-toggle">Create Job Card</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/index.php" class="dropdown-toggle">Read / Update Job Card</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/manage_job_card.php">Manage Job Card Status</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/verify_quantity.php" class="dropdown-toggle">Verify Quantity</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/verify_quality.php" class="dropdown-toggle">Verify Quality</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/assign_user.php" class="dropdown-toggle">Assign User to Job Card</a></li>
                                <li><a href="<?php echo $home_url;?>job_card_process/export_job_card.php" class="dropdown-toggle">Export Job Card Data</a></li>
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Invoice' word. -->
                        <li <?php echo $nav_title=="Invoice" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Invoice</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>invoice/index.php" class="dropdown-toggle">Read / Update Invoice</a></li>
                                <li><a href="<?php echo $home_url;?>invoice/sign_off_invoice.php">Sign-Off Invoice</a></li>
                                <li><a href="<?php echo $home_url;?>invoice/export_invoice.php" class="dropdown-toggle">Export Invoice Data</a></li>
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Business' word. -->
                        <li <?php echo $nav_title=="Business" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Business</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>business/create_business.php" class="dropdown-toggle">Create Business</a></li>
                                <li><a href="<?php echo $home_url;?>business/index.php" class="dropdown-toggle">Read / Update Business</a></li>
                                <li><a href="<?php echo $home_url;?>business/export_business.php" class="dropdown-toggle">Export Business Data</a></li>
                            </ul>
                        </li>   

                        <!-- highlight if $nav_title has 'Receipt' word. -->
                        <li <?php echo $nav_title=="Receipt" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Receipt</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>receipt/create_receipt.php" class="dropdown-toggle">Create Receipt</a></li>
                                <li><a href="<?php echo $home_url;?>receipt/index.php" class="dropdown-toggle">Read / Update Receipt</a></li>
                                <li><a href="<?php echo $home_url;?>receipt/export_receipt.php" class="dropdown-toggle">Export Receipt Data</a></li>
                            </ul>
                        </li>   

                        <!-- highlight if $nav_title has 'Reports' word. -->
                        <li <?php echo $nav_title=="Report" ? "class='active'" : ""; ?>>
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Report</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $home_url;?>report/dashboard.php" class="dropdown-toggle">Dashboard</a></li>
                                <li><a href="<?php echo $home_url;?>report/dashboard-deadline.php" class="dropdown-toggle">Dashboard - Deadline</a></li>
                                <li><a href="<?php echo $home_url; ?>report/status.php">Status</a></li>
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Admin' word. -->
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
            } else if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='User - Verify'){
                ?>
                <ul class="nav navbar-nav">
                    <!-- link to the "Home" page, highlight if current page is index.php -->
                    <li <?php echo $nav_title=="Home" ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url;?>job_card_process/index.php" class="dropdown-toggle">Home</a>
                    </li>

                    <!-- highlight if $nav_title has 'Job Card' word. -->
                    <li <?php echo $nav_title=="Job Card" ? "class='active'" : ""; ?>>
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Job Card</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo $home_url;?>job_card_process/verify_quality.php" class="dropdown-toggle">Verify Quantity</a></li>
                        </ul>
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
                    <a href="<?php echo $home_url;?>job_card_process/index.php">Home</a>
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