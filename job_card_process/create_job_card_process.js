
window.onload = checkCookie(), calculateSubTotal(), calculateInvoiceTotal();

function setCookie(){
    document.cookie = "client_business_id = " + document.getElementById("client_business_id").selectedIndex;
    document.cookie = "customer_business_id = " + document.getElementById("customer_business_id").selectedIndex;
    document.cookie = "job_card_status_id = " + document.getElementById("job_card_status_id").selectedIndex;
    document.cookie = "date_due = " + document.getElementById("date_due").value;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    setDropDownIndex("client_business_id", getCookie("client_business_id"));
    setDropDownIndex("customer_business_id", getCookie("customer_business_id"));
    setDropDownIndex("job_card_status_id", getCookie("job_card_status_id"));
    document.getElementById("date_due").value = getCookie("date_due");
}

function setDropDownIndex(dropDown,selectedIndex) {
    var dropdownlistbox = document.getElementById(dropDown);
    dropdownlistbox.selectedIndex = selectedIndex;
}

//document.getElementById("add_to_job_card").onsubmit = function() {setCookie();};

function createJobCard() {
    document.create_job_card.submit();
}

// Add customer process, redirects back to job card process after customer add 
function addCustomer() {
    window.location = "../business/create_business.php?action=from_job_card_process";
}

function calculateSubTotal(){
    var price_sub_total = document.getElementsByName("price_sub_total");

    if (price_sub_total.length >= 0) {
        
        var price_setup = document.getElementsByName("price_setup");
        var price_artwork = document.getElementsByName("price_artwork");
        var price_embroidery = document.getElementsByName("price_embroidery");
        var item_qty_verified = document.getElementsByName("item_qty_verified");
    
        for(var x=0; x < price_sub_total.length; x++)   
        {
            var subTotal = 0;
            subTotal = subTotal + parseFloat(price_setup[x].value);
            subTotal = subTotal + parseFloat(price_artwork[x].value);
            subTotal = subTotal + (parseFloat(price_embroidery[x].value) * parseInt(item_qty_verified[x].value,10));
            document.getElementsByName("price_sub_total")[x].value = subTotal;
        }
    }
}

function calculateInvoiceTotal(){
    var price_sub_total = document.getElementsByName("price_sub_total");
    var total = 0;

    for(var x=0; x < price_sub_total.length; x++)  
    {
        total = total + parseFloat(price_sub_total[x].value);
    }

    document.getElementById("total_invoiced").value = total;
}

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
                $.post('delete_line_item_temp.php', {
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