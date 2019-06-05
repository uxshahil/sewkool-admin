</div>
    <!-- /container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../libs/vendor/js/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="../libs/vendor/js/bootstrap-3.3.7.min.js"></script>
  
<!-- bootbox library -->
<script src="../libs/vendor/js/bootbox-4.4.0.min.js"></script>

<!-- JavaScript validators -->
<script src="../libs/js/validators.js"></script>

<?php 
    switch ($page_title) {
        case "Create Job Card":
            echo '<script src="create_job_card_process.js"></script>';
            break;
        case "Delete Job Card":
            echo '<script src="delete_job_card_process.js"></script>';
            break;    
        case "Read Job Card":
            echo '<script src="delete_job_card_process.js"></script>';
            echo '<script src="manage_job_card.js"></script>';
            if ($action != 'filter_status') {
                echo '<script>getJobCardStatus()</script>';
                break;
            }
            break;    
        case "Manage Job Card Status";
            echo '<script src="manage_job_card.js"></script>';
            break;
        case "Verify Quantity";
            echo '<script src="verify_quantity.js"></script>';
            break;
        case "Verify Quality";
            echo '<script src="verify_quality.js"></script>';
            break;
        case "Assign User to Job Card";
            echo '<script src="assign_user.js"></script>';
            break;
    }
?>

</body>
</html>