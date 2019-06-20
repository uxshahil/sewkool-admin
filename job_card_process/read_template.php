<?php // to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
$s = isset($_GET['s']) ? $_GET['s'] : "";
?>

<div class="row right-button-margin">

    <form role='search' action='search.php'>
        <div class='input-group col-md-3 pull-left margin-right-1em'>
            <?php $search_value=isset($search_term) ? "value='{$search_term}'" : ""; ?>
            <input type='text' class='form-control' placeholder='Type search phrase' name='s' id='srch-term' required <?php echo $search_value ?>/>
            <div class='input-group-btn'>
                <button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>
            </div>
        </div>
    </form>

    <?php 
        // display filters as default on index.php
        if( $page_url == "index.php?" ? include_once 'filter.php' : "" ); 

        // DO NOT display filters on if there is a search term
        if( isset($s) ? "" : include_once 'filter.php'); 
    ?>

</div>

<div class="row right-button-margin">
    <div class='col-md-3 pull-right'>
        <a href='create_job_card.php' class='btn btn-primary pull-right'>
            <span class='glyphicon glyphicon-plus'></span> Create Job Card
        </a>
    </div>
</div>

<?php

 
// display the Job Card if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered box'>";
        echo "<tr>";
            echo "<th>Job Card Number</th>";
            echo "<th>Client Order Number</th>";
			echo "<th>Client</th>";
			echo "<th>Status</th>";
			echo "<th></th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$client_invoice_number}</td>";
				echo "<td>{$name}</td>";
				echo "<td>{$title}</td>";

                echo "<td style='text-align: right;'>";
                    // read Job Card button
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";

                    // edit Job Card button
                    echo "<a href='update_job_card.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";

                    // print Job Card button
                    echo "<a href='print_job_card.php?id={$id}' class='btn left-margin'>";
                        echo "<span class='glyphicon glyphicon-print'></span> Print";
                    echo "</a>";

                    // delete Job Card button
                    /*echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'</span> Delete";
                    echo "</a>";*/
                echo "</td>";

            echo "</tr>";
        }
    echo "</table>";

    // paging buttons here
    include_once 'paging.php';
}
 
// tell the user there are no Job_Cards
else{
    echo "<div class='alert alert-danger'>No Job_Cards found.</div>";
}
?>