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
 
<script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){

    var id = $(this).attr('delete-id');

    bootbox.confirm({
        message: "<h4>Are you sure?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {

            if(result==true){
                $.post('delete_line_item.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete');
                });
            }
        }
    });

    return false;
});
</script>

</body>
</html>