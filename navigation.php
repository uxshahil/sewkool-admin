<!-- navbar -->

    <div class="sidebar-menu fixed">

        <div class="sidebar-menu-inner">
                
            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="index.html">
                        <img src="<?php echo $home_url . 'assets/images/logo@2x.png'?>" width="120" alt="" />
                    </a>
                </div>

                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

                                
                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>

            <?php 
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='User'){
            ?>
                                        
                    <ul id="main-menu" class="main-menu">
                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

                        <!-- link to the "Home" page, highlight if current page is index.php -->
                        <li <?php echo $nav_title=="Home" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card/index.php">
                                <i class="entypo-gauge"></i>
                                <span class="title">Home</span>
                            </a>
                        </li>

                        <li class="has-sub" <?php echo $nav_title=="Job Card" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card/index.php?>">
                                <i class="entypo-briefcase"></i>
                                <span class="title">Job Card</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/create_job_card.php">
                                        <span class="title">Create Job Card</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/index.php">
                                        <span class="title">Read / Update Job Card</span>
                                    </a>
                                </li>   
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/verify_quantity.php">
                                        <span class="title">Verify Quantity</span>
                                    </a>
                                </li>   
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/assign_user.php">
                                        <span class="title">Assign User to Job Card</span>
                                    </a>
                                </li>      
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Invoice' word. -->
                        <li class="has-sub" <?php echo $nav_title=="Invoice" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>invoice/index.php?>">
                                <i class="entypo-archive"></i>
                                <span class="title">Invoice</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>invoice/index.php">
                                        <span class="title">Read / Update Invoice</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Business' word. -->
                        <li class="has-sub" <?php echo $nav_title=="Business" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>business/index.php?>">
                                <i class="entypo-vcard"></i>
                                <span class="title">Business</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>business/create_business.php">
                                        <span class="title">Create Business</span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="<?php echo $home_url;?>business/index.php">
                                        <span class="title">Read / Update Business</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Receipt' word. -->
                        <li class="has-sub" <?php echo $nav_title=="Receipt" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>receipt/index.php?>">
                                <i class="entypo-archive"></i>
                                <span class="title">Receipt</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>receipt/create_receipt.php">
                                        <span class="title">Create Receipt</span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="<?php echo $home_url;?>receipt/index.php">
                                        <span class="title">Read / Update Receipt</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>

                    </ul>

            <?php 
            
                } else if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Admin') {

            ?>
                                        
                    <ul id="main-menu" class="main-menu">
                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

                        <!-- link to the "Home" page, highlight if current page is index.php -->
                        <li <?php echo $nav_title=="Home" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card/index.php">
                                <i class="entypo-gauge"></i>
                                <span class="title">Home</span>
                            </a>
                        </li>

                        <li class="has-sub" <?php echo $nav_title=="Job Card" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card/index.php?>">
                                <i class="entypo-briefcase"></i>
                                <span class="title">Job Card</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/create_job_card.php">
                                        <span class="title">Create Job Card</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/index.php">
                                        <span class="title">Read / Update Job Card</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/manage_job_card.php">
                                        <span class="title">Manage Job Card Status</span>
                                    </a>
                                </li>   
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/verify_quantity.php">
                                        <span class="title">Verify Quantity</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/verify_quality.php">
                                        <span class="title">Verify Quality</span>
                                    </a>
                                </li>   
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/assign_user.php">
                                        <span class="title">Assign User to Job Card</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/export_job_card.php">
                                        <span class="title">Export Job Card</span>
                                    </a>
                                </li>      
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Invoice' word. -->
                        <li class="has-sub" <?php echo $nav_title=="Invoice" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>invoice/index.php?>">
                                <i class="entypo-archive"></i>
                                <span class="title">Invoice</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>invoice/index.php">
                                        <span class="title">Read / Update Invoice</span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="<?php echo $home_url;?>invoice/sign_off_invoice.php">
                                        <span class="title">Sign-Off Invoice</span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="<?php echo $home_url;?>invoice/export_invoice.php">
                                        <span class="title">Export Invoice</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Business' word. -->
                        <li class="has-sub" <?php echo $nav_title=="Business" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>business/index.php?>">
                                <i class="entypo-vcard"></i>
                                <span class="title">Business</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>business/create_business.php">
                                        <span class="title">Create Business</span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="<?php echo $home_url;?>business/index.php">
                                        <span class="title">Read / Update Business</span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="<?php echo $home_url;?>business/index.php">
                                        <span class="title">Export Business Data</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Receipt' word. -->
                        <li class="has-sub" <?php echo $nav_title=="Receipt" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>receipt/index.php?>">
                                <i class="entypo-archive"></i>
                                <span class="title">Receipt</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>receipt/create_receipt.php">
                                        <span class="title">Create Receipt</span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="<?php echo $home_url;?>receipt/index.php">
                                        <span class="title">Read / Update Receipt</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $home_url;?>receipt/index.php">
                                        <span class="title">Export Receipt Data</span>
                                    </a>
                                </li>  
                            </ul>
                        </li>

                        <!-- highlight if $nav_title has 'Admin' word. -->
                        <li class="has-sub" <?php echo $nav_title=="Admin" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>admin/index.php?>">
                                <i class="entypo-archive"></i>
                                <span class="title">Admin</span>
                            </a>
                        </li>

                    </ul>

            <?php 
            
                } else if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='User - Verify'){

            ?>
                                        
                    <ul id="main-menu" class="main-menu">
                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

                        <!-- link to the "Home" page, highlight if current page is index.php -->
                        <li <?php echo $nav_title=="Home" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card/index.php">
                                <i class="entypo-gauge"></i>
                                <span class="title">Home</span>
                            </a>
                        </li>

                        <li class="has-sub" <?php echo $nav_title=="Job Card" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card/index.php?>">
                                <i class="entypo-briefcase"></i>
                                <span class="title">Job Card</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo $home_url;?>job_card/verify_quantity.php">
                                        <span class="title">Verify Quantity</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

            <?php 
                } else {
            ?>
                                        
                    <ul id="main-menu" class="main-menu">
                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

                        <!-- link to the "Home" page, highlight if current page is index.php -->
                        <li <?php echo $nav_title=="Home" ? "class='active'" : ""; ?>>
                            <a href="<?php echo $home_url;?>job_card/index.php">
                                <i class="entypo-gauge"></i>
                                <span class="title">Home</span>
                            </a>
                        </li>

                    </ul>

            <?php 
                }
            ?>
            
        </div>

    </div>
<!-- /navbar -->