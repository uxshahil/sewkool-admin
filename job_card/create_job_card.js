window.onload = 

    setDefaultDates(), 
    setDefaultDropdowns(), 
    setDefaultRadioButtons(), 

    checkCookie(), 

    calculateSubTotal(), 
    calculateInvoiceTotal();

function setDefaultDates(){

    var currentTime = new Date();

    // Default Invoice Date Due = 30 Days
    currentTime.setDate(currentTime.getDate()+30)
    document.getElementById("date_due").value = currentTime.toISOString().slice(0,10);

    // Default Deadline Date = 14 Days
    currentTime.setDate(currentTime.getDate()+14)
    document.getElementById("deadline_date").value = currentTime.toISOString().slice(0,10);

}

function setDefaultDropdowns(){

    // Job Type Default = Embroidery = 11
    document.getElementById("job_type_id").value = 11;

}

function setDefaultRadioButtons(){

    // Priority Default = Normal = 8
    document.getElementById("priority_id_default").checked = true;

}

function setCookie(){

    document.cookie = "client_business_id = " + document.getElementById("client_business_id").selectedIndex;
    document.cookie = "customer_business_id = " + document.getElementById("customer_business_id").selectedIndex;
    document.cookie = "date_due = " + document.getElementById("date_due").value;
    document.cookie = "client_invoice_number = " + document.getElementById("client_invoice_number").value;
    document.cookie = "skip_artwork = " + document.getElementById("skip_artwork").selectedIndex;
    document.cookie = "qty_verify_customer = " + document.getElementById("qty_verify_customer").value;
    document.cookie = "job_type_id = " + document.getElementById("job_type_id").selectedIndex;
    document.cookie = "deadline_date = " + document.getElementById("deadline_date").value;
    document.cookie = "deadline_enforce = " + document.getElementById("deadline_enforce").selectedIndex;
    document.cookie = "priority_id = " + document.querySelector('input[name="priority_id"]:checked').value;

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

    if (getCookie("client_business_id") != "") 
        { setDropDownIndex("client_business_id", getCookie("client_business_id")) };

    if(getCookie("customer_business_id") != "") 
        { setDropDownIndex("customer_business_id", getCookie("customer_business_id")) };

    if(getCookie("client_invoice_number") != "") 
        { document.getElementById("client_invoice_number").value = getCookie("client_invoice_number") };

    if(getCookie("date_due") != "") 
        { document.getElementById("date_due").value = getCookie("date_due") };

    if(getCookie("skip_artwork") != "") 
        { setDropDownIndex("skip_artwork", getCookie("skip_artwork")) };

    if(getCookie("qty_verify_customer") != "") 
        { document.getElementById("qty_verify_customer").value = getCookie("qty_verify_customer") };

    if(getCookie("job_type_id") != "") 
        { setDropDownIndex("job_type_id", getCookie("job_type_id")) };

    if(getCookie("deadline_enforce") != "") 
        { setDropDownIndex("deadline_enforce", getCookie("deadline_enforce")) };

    if(getCookie("deadline_date") != "") 
        { document.getElementById("deadline_date").value = getCookie("deadline_date") };

    if(getCookie("priority_id") != "") 
        {setRadioButtonIndex("priority_id", getCookie("priority_id")) };

}

function setDropDownIndex(dropDown,selectedIndex) {

    var dropdownlistbox = document.getElementById(dropDown);
    dropdownlistbox.selectedIndex = selectedIndex;

}

function setRadioButtonIndex(radiobtn,selectedIndex) {

    var radioItems = document.getElementsByName(radiobtn);

	for(var i = 0; i < radioItems.length; i++) { 

		if(radioItems[i].value == selectedIndex) {
            
			radioItems[i].checked = true;
        }
        
	}

} 

//document.getElementById("add_to_job_card").onsubmit = function() {setCookie();};

function createJobCard() {

    document.create_job_card.submit();

}

// Add customer process, redirects back to job card process after customer add 
function addCustomer() {

    window.location = "../business/create_business.php?action=from_job_card";

}

function calculateSubTotal(){

    var price_sub_total = document.getElementsByName("price_sub_total");

    if (price_sub_total.length >= 0) {
        
        var price_setup = document.getElementsByName("price_setup");
        var price_artwork = document.getElementsByName("price_artwork");
        var price_embroidery = document.getElementsByName("price_embroidery");
        var item_qty = document.getElementsByName("item_qty");
    
        for(var x=0; x < price_sub_total.length; x++)   
        {
            var subTotal = 0;
            subTotal = subTotal + parseFloat(price_setup[x].value);
            subTotal = subTotal + parseFloat(price_artwork[x].value);
            subTotal = subTotal + (parseFloat(price_embroidery[x].value) * parseInt(item_qty[x].value,10));
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

window.onload = function() {

    if (document.getElementById("header1")) {

        document.getElementById("jobCardSubmit").disabled = false;

    } else {
        
        document.getElementById("jobCardSubmit").disabled = true;

    }

}