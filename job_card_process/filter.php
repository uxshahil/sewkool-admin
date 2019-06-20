<form name="filter_job_card" role='filter' method="post">
    
    <div class="col-md-3">

        <?php
            $stmt_a = $status->readParentStatus("job_card","job_card_status_id");

            // put them in a select drop-down
            echo "<select id='job_card_phase' class='form-control' name='job_card_phase' onClick='filterPhase()'>";
            
                echo "<option>Please select...</option>";
                while ($row_status = $stmt_a->fetch(PDO::FETCH_ASSOC)){
                    $status_id = $row_status['id'];
                    $status_title = $row_status['title'];

                    if ($status_id == $job_card_phase_id)
                    {
                        echo "<option value='$status_id' selected>$status_title</option>";
                    }
                    else {
                        echo "<option value='$status_id'>$status_title</option>";
                    }
                }
            echo "</select>";
        ?>

    </div>

    <div class="col-md-3">
        <!-- <select id='job_card_status_id' class='form-control' name='job_card_status_id' onClick='filterStatus()'></select> -->
        
        <?php
            $stmt_b = $status->readChildStatusID("job_card","job_card_status_id",$job_card_phase_id);
            
            // put them in a select drop-down
            echo "<select id='job_card_status_id' class='form-control' name='job_card_status_id' onClick='filterStatus()'>";
            
                echo "<option>Please select...</option>";
                while ($row_status = $stmt_b->fetch(PDO::FETCH_ASSOC)){
                    $status_id = $row_status['id'];
                    $status_title = $row_status['title'];

                    if ($status_id == $job_card_status_id)
                    {
                        echo "<option value='$status_id' selected>$status_title</option>";
                    }
                    else {
                        echo "<option value='$status_id'>$status_title</option>";
                    }
                }
            echo "</select>";
        ?>
    </div>

    <div class="col-md-3">
        
        <?php
            
            // put them in a select drop-down
            echo "<select id='no_void_no_invoiced' class='form-control' name='no_void_no_invoiced' onClick='filterNoVoidNoInvoiced()'>";
                
                if($action=='no_void_no_invoiced'){
                    echo "<option selected>No Void & Invoiced</option>";
                    echo "<option>No Void</option>";     
                    echo "<option>No Invoiced</option>";
                    echo "<option>Read All</option>";
                } 
                
                else if ($action=='no_void'){
                    echo "<option>No Void & Invoiced</option>";
                    echo "<option selected>No Void</option>";     
                    echo "<option>No Invoiced</option>";
                    echo "<option>Read All</option>";
                } 
                
                else if ($action=='no_invoiced'){
                    echo "<option>No Void & Invoiced</option>";
                    echo "<option>No Void</option>";     
                    echo "<option selected>No Invoiced</option>";
                    echo "<option>Read All</option>";
                } 
                
                else if ($action=='no_filter'){
                    echo "<option>No Void & Invoiced</option>";
                    echo "<option>No Void</option>";     
                    echo "<option>No Invoiced</option>";
                    echo "<option selected>Read All</option>";
                } 

                else {
                    echo "<option selected>No Void & Invoiced</option>";
                    echo "<option>No Void</option>";     
                    echo "<option>No Invoiced</option>";
                    echo "<option>Read All</option>";
                }            
                                
            echo "</select>";
        ?>
    </div>

</form>