<?php // to prevent undefined index notice
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $s = isset($_GET['s']) ? $_GET['s'] : "";
?>

<body class="page-body page-fade gray" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <?php include_once $root_dir .'navigation.php' ?>

	<div class="main-content">

        <?php include_once $root_dir .'user/profile_info.php'; ?>
        
            <hr />

        <?php
        
        // Display page title & object navigation breadcrumb
        
            echo "<div class='row'>

                    <div class='col-md-12'>
        
                        <ol class='breadcrumb bc-3'>

                            <li class='active'>
                                <a href='{$home_url}/job_card'>
                                    <i class='entypo-briefcase'></i>
                                    Job Card
                                </a>
                            </li>

                        </ol> 
                        
                        <h1>{$nav_title}</h1>

                    </div>

                </div>"
            
        ?>

        <div class="row">
            <!--<div class="col-md-2">
                <div class='row'>
                    <div class="col-md-12">                
                        <a href='create_job_card.php' class='btn btn-primary pull-right'>
                            <span class='glyphicon glyphicon-plus'></span> Create Job Card
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form role='search' action='search.php'>
                            <div class='input-group col-md-12 pull-left margin-right-1em'>
                                <?php /*$search_value=isset($search_term) ? "value='{$search_term}'" : ""; */?>
                                <input type='text' class='form-control' placeholder='Type search phrase' name='s' id='srch-term' required <?php/* echo $search_value */?>/>
                                <div class='input-group-btn'>
                                    <button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php/* 
                    // display filters as default on index.php
                    if( $page_url == "index.php?" ? include_once 'filter.php' : "" ); 

                    // DO NOT display filters on if there is a search term
                    if( isset($s) ? "" : include_once 'filter.php'); */
                ?>
            </div>-->

            <div class="col-md-12">

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

            </div>
        
        </div>

		<!-- Footer -->
		<footer class="main">
			
			&copy; 2019 <strong>Sewkool</strong> Powered by <a href="https://themidastouch.co.za" target="_blank">The Midas Touch</a>
		
		</footer>
	</div>
	
</div>

<?php
// layout_footer.php holds our import variables
include_once "layout_footer.php";
?>

</body>
</html>