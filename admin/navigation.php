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
 
            <!-- Change "Site Admin" to your site name -->
            <a class="navbar-brand" href="<?php echo $home_url; ?>admin/index.php">Admin</a>
        </div>
 
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
 
                <!-- highlight if $nav_title has 'User' word. -->
                <li <?php echo $nav_title=="User" ? "class='active'" : ""; ?>>
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $home_url;?>user/index.php" class="dropdown-toggle">Read / Update User</a></li>
                        <li><a href="<?php echo $home_url;?>user/export_user.php" class="dropdown-toggle">Export User Data</a></li>
                    </ul>                
                </li>

                <!-- highlight if $nav_title has 'Status' word. -->
                <li <?php echo $nav_title=="Status" ? "class='active'" : ""; ?>>
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Status</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $home_url;?>status/index.php" class="dropdown-toggle">Read / Update Status</a></li>                        
                        <li><a href="<?php echo $home_url;?>status/export_status.php" class="dropdown-toggle">Export Status Data</a></li>
                    </ul>                
                </li>

                <!-- highlight if $nav_title has 'Lookup' word. -->
                <li <?php echo $nav_title=="Lookup" ? "class='active'" : ""; ?>>
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Lookup</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $home_url;?>lookup/index.php" class="dropdown-toggle">Read / Update Lookup</a></li>
                        <li><a href="<?php echo $home_url;?>lookup/export_lookup.php" class="dropdown-toggle">Export Lookup Data</a></li>
                    </ul>                
                </li>

                <li>
                    <a href="<?php echo $home_url; ?>job_card_process/index.php">SewKool - App</a>
                </li>
            </ul>
 
            <!-- options in the upper right corner of the page -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        &nbsp;&nbsp;<?php echo $_SESSION['first_name']; ?>
                        &nbsp;&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <!-- log out user -->
                        <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
 
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->