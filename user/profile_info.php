<?php
// core.php holds pagination variables
include_once '/Users/admin/Sites/wamp64/www/sewkool-admin/config/core.php';

// include database and object files
include_once $root_dir .'config/database.php';
include_once $root_dir .'objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$user = new User($db);

// set ID property of user to be read
$user->id = $_SESSION['user_id'];

// read the details of user to be read
$user->readOne();
?>

<div class="row">

    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">

        <ul class="user-info pull-left pull-none-xsm">

            <!-- Profile Info -->
            <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $home_url . "images/" . $user->image ?>" alt="" class="img-circle" width="44" />
                    <?php echo $user->first_name . " " . $user->last_name; ?>
                </a>

                <ul class="dropdown-menu">

                    <!-- Reverse Caret -->
                    <li class="caret"></li>

                    <!-- Profile sub-links -->
                    <li>
                        <a href="<?php echo $home_url ."user/update_user.php?id=". $user->id ?>">
                            <i class="entypo-user"></i>
                            Edit Profile
                        </a>
                    </li>

                </ul>
            </li>

        </ul>

    </div>


    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">

        <ul class="list-inline links-list pull-right">

            <li>
                <a href="<?php echo $home_url; ?>logout.php">
                    Log Out <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>

    </div>

</div>