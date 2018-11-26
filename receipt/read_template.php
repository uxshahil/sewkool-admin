<?php
// search form
echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type search phrase' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
 
// create receipt button
echo "<div class='right-button-margin'>";
    echo "<a href='create_receipt.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create receipt";
    echo "</a>";
echo "</div>";
 
// display the receipt if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered box'>";
        echo "<tr>";
            echo "<th>Receipt Number</th>";
            echo "<th>Client</th>";
            echo "<th>Amount Receipted</th>";
            echo "<th>Payment Reference</th>";
            echo "<th></th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            echo "<tr>";
				echo "<td>{$id}</td>";
				echo "<td>{$client_business_id}</td>";
				echo "<td>{$amount_receipted}</td>";
				echo "<td>{$payment_reference}</td>";

                echo "<td style='text-align: right;'>";
                    // read receipt button
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";

                    // edit receipt button
                    echo "<a href='update_receipt.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";

                    // print receipt button
                    echo "<a href='print_receipt.php?id={$id}' class='btn left-margin'>";
                        echo "<span class='glyphicon glyphicon-print'></span> Print";
                    echo "</a>";

                    // delete receipt button
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
 
// tell the user there are no Receipts
else{
    echo "<div class='alert alert-danger'>No Receipts found.</div>";
}
?>