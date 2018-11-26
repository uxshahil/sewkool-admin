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
        case "Create Job_Card":
            echo '<script src="create_job_card_process.js"></script>';
            break;
        case "Delete Job_Card":
            echo '<script src="delete_job_card_process.js"></script>';
            break;    
        case "Read Job_Card":
            echo '<script src="delete_job_card_process.js"></script>';
            break;    
    }
?>

</body>
</html>