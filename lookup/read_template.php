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
 
// create lookup button
echo "<div class='right-button-margin'>";
    echo "<a href='create_lookup.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create lookup";
    echo "</a>";
echo "</div>";
 
// display the lookup if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered box'>";
        echo "<tr>";
			echo "<th>id</th>";
			echo "<th>collection</th>";
            echo "<th>title</th>";
            echo "<th></th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            echo "<tr>";
				echo "<td>{$id}</td>";
				echo "<td>{$collection}</td>";
				echo "<td>{$title}</td>";

                echo "<td style='text-align: right;'>";
                    // read lookup button
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";

                    // edit lookup button
                    /*echo "<a href='update_lookup.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";

                    // delete lookup button
                    echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'</span> Delete";
                    echo "</a>";*/
                echo "</td>";

            echo "</tr>";
        }
    echo "</table>";

    // paging buttons here
    include_once 'paging.php';
}
 
// tell the user there are no Lookup
else{
    echo "<div class='alert alert-danger'>No Lookup found.</div>";
}
?>