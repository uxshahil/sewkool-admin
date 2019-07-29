<?php // to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
$s = isset($_GET['s']) ? $_GET['s'] : "";
?>

<!--
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
        /*if( $page_url == "index.php?" ? include_once 'filter.php' : "" ); 

        // DO NOT display filters on if there is a search term
        if( isset($s) ? "" : include_once 'filter.php');*/
    ?>

</div>
-->

<div class="row right-button-margin">
    <div class='col-md-3 pull-right'>
        <a href='create_job_card.php' class='btn btn-primary pull-right'>
            <span class='glyphicon glyphicon-plus'></span> Create Job Card
        </a>
    </div>
</div>

<script type="text/javascript">
    jQuery( document ).ready( function( $ ) {
        var $table3 = jQuery("#datatable-1");
        
        var table3 = $table3.DataTable( {
            select: true,
            dom: 'lBfrtips',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'print'
            ],
            "lengthMenu": [[ 50, 10, 25, -1 ], [ 50, 10, 25, "All" ]]
        } );
        
        // Initalize Select Dropdown after DataTables is created
        $table3.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
        
        // Setup - add a text input to each footer cell
        $( '#datatable-1 tfoot th' ).each( function () {
            var title = $('#datatable-1 thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="form-control" placeholder="Search ' + title + '" />' );
        } );
        
        // Apply the search
        table3.columns().every( function () {
            var that = this;
        
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    } );
</script>

<?php
// display the Job Card if there are any
if ($total_rows>0)
{
    
    echo "<table id='datatable-1' class='table table-hover table-responsive table-bordered box'>
            <thead>
                <tr>
                    <th>Job Card Number</th>
                    <th>Client Order Number</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {                                    
            extract($row);

            echo "<tr>
                    <td>{$id}</td>
                    <td>{$client_invoice_number}</td>
                    <td>{$name}</td>
                    <td>{$title}</td>

                    <td style='text-align: right;'>" .
                        // read Job Card button
                        "<a href='read_one.php?id={$id}' class='btn btn-default btn-sm btn-icon icon-left'>
                            <i class='entypo-eye'></i>
                            Read
                        </a>" .

                        // edit Job Card button
                        "<a href='update_job_card.php?id={$id}' class='btn btn-default btn-sm btn-icon icon-left'>
                            <i class='entypo-pencil'></i>
                            Edit
                        </a>" .

                        // print Job Card button
                        "<a href='print_job_card.php?id={$id}' class='btn btn-default btn-sm btn-icon icon-left'>
                            <i class='entypo-print'></i>
                            Print
                        </a>" .

                        // delete Job Card button
                        /*echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                            echo "<span class='glyphicon glyphicon-remove'</span> Delete";
                        echo "</a>";*/
                    "</td>
                </tr>";                                        
        }

    echo "</tbody>

        <tfoot>
            <tr>
                <th>Job Card Number</th>
                <th>Client Order Number</th>
                <th>Client</th>
                <th>Status</th>
                <th></th>
            </tr>
        </tfoot>

    </table>";

    // paging buttons here
    include_once 'paging.php';
}

// tell the user there are no Job_Cards
else
{
    echo "<div class='alert alert-danger'>No Job_Cards found.</div>";
}
?>