
    <!-- Imported styles on this page -->
	<link rel="stylesheet" href="../assets/js/datatables/datatables.css">
	<link rel="stylesheet" href="../assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="../assets/js/select2/select2.css">

	<!-- Bottom scripts (common) -->
	<script src="../assets/js/gsap/TweenMax.min.js"></script>
	<script src="../assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<!-- <script src="assets/js/bootstrap.js"></script>-->
    <script src="../libs/vendor/js/bootstrap-3.3.7.min.js"></script>
	<script src="../assets/js/joinable.js"></script>
	<script src="../assets/js/resizeable.js"></script>
	<script src="../assets/js/neon-api.js"></script>

	<!-- Imported scripts on this page -->
	<script src="../assets/js/datatables/datatables.js"></script>
	<script src="../assets/js/select2/select2.min.js"></script>
	<script src="../assets/js/neon-chat.js"></script>

	<!-- JavaScripts initializations and stuff -->
	<script src="../assets/js/neon-custom.js"></script>

	<!-- Demo Settings 
    <script src="assets/js/neon-demo.js"></script> -->
    
    <!-- bootbox library -->
    <script src="../libs/vendor/js/bootbox-4.4.0.min.js"></script>

    <!-- JavaScript validators -->
    <script src="../libs/js/validators.js"></script>

    <?php 
        switch ($page_title) 
        {
            case "Create Job Card":
                echo '<script src="create_job_card.js"></script>';
                break;
            case "Delete Job Card":
                echo '<script src="delete_job_card.js"></script>';
                break;    
            case "Read Job Card":
                echo '<script src="delete_job_card.js"></script>';
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